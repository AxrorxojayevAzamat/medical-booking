<?php


namespace App\Services\Book\Click;


use App\Entity\Book\Book;
use App\Entity\Book\Payment\Click;
use App\Exceptions\ClickException;
use App\Helpers\ClickHelper;
use App\Helpers\ResponseHelper;
use App\Validators\Book\ClickValidator;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;

class ClickService
{
    protected $validator;
    protected $apis;
    protected $request;
    protected $config;
    protected $type;

    public function __construct()
    {
        $this->validator = new ClickValidator('click');
        $this->apis = new ClickApiService('click');
        $this->request = new RequestService();
        $this->config = config('click');
    }

    public function payment(Request $request)
    {
        $check = $this->request->payment($request);

        if ($check['type'] === 'phone_number') {
            return $this->createInvoice($check);
        }

        if ($check['type'] === 'card_number') {
            return $this->createCardToken($check);
        }

        if ($check['type'] === 'sms_code') {
            return $this->verifyCardToken($check);
        }

        if ($check['type'] === 'card_token') {
            return $this->performPayment($check['card_token'], $check['account_id']);
        }

        if ($check['type'] === 'delete_card_token') {
            return $this->deleteCardToken($check);
        }

        if ($check['type'] === 'check_invoice_id') {
            return $this->checkInvoice($check);
        }

        if ($check['type'] === 'check_payment') {
            return $this->checkPayment($check);
        }

        if ($check['type'] === 'merchant_trans_id') {
            return $this->checkPaymentStatus($check);
        }

        if ($check['type'] === 'cancel') {
            return $this->cancel($check);
        }

        throw new ClickException('Could not detect the method', ResponseHelper::CODE_ERROR, ClickException::ERROR_INSUFFICIENT_PRIVILEGE
        );
    }

    public function createInvoice(Request $request)
    {
        $payment = $this->findByToken($request->transaction_id);
        if (!in_array($payment->status, [ClickHelper::INPUT, ClickHelper::REFUNDED])) {
            return ['error_code' => -31300, 'error_note' => 'Payment in processing'];
        }

        $response = $this->apis->createInvoice([
            'service_id' => $this->config['service_id'],
            'merchant_trans_id' => $payment->merchant_transaction_id,
            'phone_number' => $request->phone_number,
            'amount' => $payment->amount
        ]);

        return $this->baseMethod($response, $payment, function ($data, Click $payment) use ($request): Click {
            if ((int)$data['error_code'] == ClickValidator::SUCCESS) {
                $payment->setStatus(ClickHelper::WAITING, $data->error_note, ['invoice_id' => $data['invoice_id'], 'phone_number' => $request->phone_number]);
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);

            }
            $payment->update();
            return $payment;
        });
    }

    public function createCardToken(Request $request): Click
    {
        $payment = $this->findByToken($request->transaction_id);
        if (!in_array($payment->status, [ClickHelper::INPUT, ClickHelper::REFUNDED])) {
            throw new ClickException('Payment in processing', ResponseHelper::CODE_ERROR, ClickException::ERROR_PAYMENT_IN_PROCESSING);
        }

        $response = $this->apis->createCardToken([
            'service_id' => $this->config['service_id'],
            'card_number' => $request->card_token,
            'expire_date' => $request->expire_date,
            'temporary' => $request->temporary ?? 0,
        ]);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code == ClickValidator::SUCCESS) {
                $payment->setStatus(ClickHelper::WAITING, $data->error_note, ['card_token' => $data->card_token, 'phone_number' => $data->phone_number]);
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);
            }
            $payment->update();
            return $payment;
        });
    }

    public function verifyCardToken(Request $request): Click
    {
        $payment = $this->findByToken($request->transaction_id);
        if ($payment->status !== ClickHelper::WAITING) {
            throw new ClickException('Payment is not stable to perform', ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM);
        }

        $response = $this->apis->verifyCardToken([
            'service_id' => $this->config['service_id'],
            'card_token' => $request->card_token,
            'sms_code' => $request->sms_code,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new ClickException($response->getReasonPhrase(), ResponseHelper::CODE_ERROR, ClickException::ERROR_INSUFFICIENT_PRIVILEGE);
        }

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code == ClickValidator::SUCCESS) {
                $payment->setStatus(ClickHelper::CONFIRMED, $data->error_note, ['card_number' => $data->card_token]);
            } else {
                $payment->setStatus(ClickHelper::CONFIRMED, $data->error_note);
            }
            $payment->update();

            return $payment;
        });
    }

    public function deleteCardToken(Request $request): Click
    {
        $payment = $this->findByToken($request->transaction_id);
        if ($payment->card_token !== $request->card_token) {
            throw new ClickException('Incorrect card token', ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM);
        }

        $response = $this->apis->deleteCardToken($request->card_token);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === ClickValidator::SUCCESS) {
                $payment->setAttributes(['card_token' => null, 'status_note' => $data->error_note]);
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);
            }
            $payment->update();

            return $payment;
        });
    }

    public function createOrder(int $userId, int $doctorId, int $clinicId, string $bookingDate, string $timeStart, int $amount, string $description): Click
    {
        DB::beginTransaction();
        try {
            $book = Book::new($userId, $doctorId, $clinicId, $bookingDate, $timeStart, null, $description, Book::CLICK);

            $order = Click::create([
                'book_id' => $book->id,
                'merchant_transaction_id' => Str::random(20) . time(),
                'amount' => $amount,
                'status' => ClickHelper::INPUT,
                'created_at' => time(),
            ]);

            DB::commit();

            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function performPayment(string $cardToken, int $token): Click
    {
        $payment = $this->findByToken($token);
        if ($payment->card_token !== $cardToken) {
            throw new ClickException('Incorrect card token', ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM);
        }

        $response = $this->apis->performPayment([
            'service_id' => $this->config['service_id'],
            'card_token' => $cardToken,
            'amount' => (float)($payment->amount / 100),
            'transaction_parameter' => $payment->merchant_transaction_id,
        ]);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === ClickValidator::SUCCESS) {
                $payment->setStatus(ClickHelper::CONFIRMED, $data->error_note, ['payment_id' => $data->payment_id]);
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);
            }

            $payment->refresh();

            return $payment;
        });
    }

    public function checkInvoice(Request $request): Click
    {
        $payment = $this->findByToken($request->transaction_id);

        if ($payment->invoice_id !== $request->invoice_id) {
            throw new ClickException('Incorrect invoice id', ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM);
        }
        $response = $this->apis->checkInvoice(['service_id' => $this->config['service_id'], 'invoice_id' => $request['invoice_id']]);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === ClickValidator::SUCCESS) {
                if ((int)$data->status > 0) {
                    $payment->setStatus(ClickHelper::CONFIRMED, $data->error_note);
                    return $this->pay($payment);
                } else if ((int)$data->status == -99) {
                    $payment->setStatus(ClickHelper::REJECTED, $data->error_note);
                } else {
                    $payment->setStatus(ClickHelper::ERROR, $data->error_note);
                }
                $payment->update();
            }

            return $payment;
        });
    }

    public function checkPayment(Request $request): Click
    {
        $payment = $this->findByToken($request->transaction_id);
        if ($payment->status === ClickHelper::CONFIRMED) {
            return $payment;
        }
        $response = $this->apis->checkPayment($payment->payment_id);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === ClickValidator::SUCCESS) {
                if ((int)$data->status > 0) {
                    $payment->setStatus(ClickHelper::CONFIRMED, $data->error_note);
                } else if ((int)$data->status === -99) {
                    $payment->setStatus(ClickHelper::REJECTED, $data->error_note);
                } else {
                    $payment->setStatus(ClickHelper::ERROR, $data->error_note);
                }
                $payment->update();
            }
            return $payment;
        });
    }

    public function checkPaymentStatus(Request $request): Click
    {
        $payment = $this->findByToken($request->transaction_id);
        $response = $this->apis->checkPaymentStatus($payment->merchant_transaction_id);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === ClickValidator::SUCCESS) {
                $payment->setAttributes([
                    'payment_id' => $data->payment_id,
                    'status_note' => $data->error_note,
                ]);
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);
            }
            $payment->update();

            return $payment;
        });
    }

    public function cancel(Request $request): Click
    {
        $response = $this->apis->onCanceling($request->payment_id);
        $payment = $this->findByToken($request->transaction_id);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === ClickValidator::SUCCESS) {
                $payment->setStatus(ClickHelper::REJECTED, $data->error_note, ['payment_id' => $data->payment_id]);
                $payment->update();
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);
                $payment->update();
            }

            return $payment;
        });
    }

    public function prepare(Request $request): array
    {
        $result = [];
        $merchantConfirmId = 0;
        $merchantPrepareId = 0;

        if ($payment = Click::where('merchant_transaction_id', $request->merchant_trans_id)->first()) {
            $merchantConfirmId = $payment->id;
            $merchantPrepareId = $payment->id;
        }

        $this->validate($request, $result, $payment);

        $result += [
            'click_trans_id' => $request->click_trans_id,
            'merchant_trans_id' => $request->merchant_trans_id,
            'merchant_confirm_id' => $merchantConfirmId,
            'merchant_prepare_id' => $merchantPrepareId,
        ];

        if ($result['error'] === ClickValidator::SUCCESS) {
            $payment->changeStatus(ClickHelper::WAITING);
            $payment->update(['click_transaction_id' => $request->click_trans_id]);
        }

        return $result;
    }

    public function complete(Request $request): array
    {
        $result = [];
        $merchantConfirmId = 0;
        $merchantPrepareId = 0;

        if ($payment = Click::where('merchant_transaction_id', $request->merchant_trans_id)->first()) {
            $merchantConfirmId = $payment->id;
            $merchantPrepareId = $payment->id;
        }

        $this->validate($request, $result, $payment);

        $result += [
            'click_trans_id' => $request->click_trans_id,
            'merchant_trans_id' => $request->merchant_trans_id,
            'merchant_confirm_id' => $merchantConfirmId,
            'merchant_prepare_id' => $merchantPrepareId,
        ];

        if ($request->error < 0 && !in_array($result['error'], [ClickValidator::ALREADY_PAID, ClickValidator::TRANSACTION_CANCELLED])) {
            $payment->changeStatus(ClickHelper::REJECTED);
            $payment->update();

            return ['error' => ClickValidator::TRANSACTION_CANCELLED, 'error_note' => 'Transaction cancelled'];
        } elseif ($result['error'] === ClickValidator::SUCCESS) {
            $payment = $this->pay($payment);
        }

        return $result;
    }

    ################################################################################# Helper functions

    protected function validate($request, &$result, Click $payment = null): void
    {
        try {
            $this->validator->validateBasic($request);
            $this->validator->requestCheck($request);
            if (!$payment) {
                $result = ['error' => ClickValidator::USER_NOT_FOUND, 'error_note' => 'Transaction does not exist'];
            }
            $this->validator->checkPayment($request, $payment);
            $result = ['error' => ClickValidator::SUCCESS, 'error_note' => 'Success'];
        } catch (ValidationException $e) {
            $result = ['error' => ClickValidator::REQUEST_ERROR, 'error_note' => 'Error in request from click'];
        } catch (\DomainException $e) {
            $result = ['error' => ClickValidator::USER_NOT_FOUND, 'error_note' => 'Transaction does not exist'];
        } catch (ClickException $e) {
            $result = ['error' => $e->getClickCode(), 'error_note' => $e->getMessage()];
        }
    }

    protected function baseMethod(ResponseInterface $response, Click $payment, callable $func)
    {
        try {
            if (!$this->apis->isResponseSuccessful($response)) {
                throw new ClickException($response->getReasonPhrase(),ResponseHelper::CODE_ERROR, ClickException::ERROR_INSUFFICIENT_PRIVILEGE);
            }

            return $func(json_decode($response->getBody()), $payment);
        } catch (RequestException $e) {
            throw new ClickException($e->getMessage(),ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM);
        }
    }

    protected function pay(Click $payment, $params = [], $notes = ''): Click
    {
        $payment->pay($params, $notes);
        $book = $payment->book;
        $book->activate();

        DB::beginTransaction();
        try {
            $book->update();
            $payment->update();
            DB::commit();

            return $payment;
        } catch (\DomainException|\RuntimeException $e) {
            DB::rollBack();
            throw new ClickException('Update failed',ResponseHelper::CODE_ERROR, ClickValidator::UPDATE_FAILED);
        }
    }

    public function findByToken($token): Click
    {
        if (!$click = Click::where('merchant_transaction_id', $token)->first()) {
            throw new \DomainException('Click order is not found.');
        }
        return $click;
    }
}
