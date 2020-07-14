<?php


namespace App\Services\Book\Paycom;


use App\Entity\Book\Payment\PaycomTransaction;
use App\Exceptions\PaycomException;
use App\Helpers\Format;
use App\Helpers\PaycomRequest;
use App\Helpers\PaycomResponse;
use App\ReadModels\Book\PaycomRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ApplicationService
{
    private $config;
    private $request;
    private $response;
    private $orders;

    public function __construct()
    {
        $this->config = config('paycom_config');
        if ($this->config['keyFile']) {
            $this->config['key'] = trim(file_get_contents($this->config['keyFile']));
        }

        $this->request = new PaycomRequest();
        $this->response = new PaycomResponse($this->request);
        $this->orders = new PaycomRepository($this->request->id);
    }

    public function run()
    {
        try {
            $this->authorize($this->request->id);
            $functionName = lcfirst($this->request->method);

            if (!method_exists($this, $functionName)) {
                $this->throwError('Method not found.', PaycomException::ERROR_METHOD_NOT_FOUND, $this->request->method);
            }

            return $this->{$functionName}();
        } catch (\DomainException $e) {
            return (new PaycomException($e->getMessage(), PaycomException::ERROR_INTERNAL_SYSTEM, $this->request->method))->send();
        } catch (PaycomException $e) {
            return $e->send();
        }
    }

    private function authorize($request_id): void
    {
        $headers = getallheaders();
        if (!$headers || !isset($headers['Authorization']) ||
            !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $headers['Authorization'], $matches) ||
            base64_decode($matches[1]) != $this->config['login'] . ":" . $this->config['key']
        ) {
            throw new PaycomException($request_id, 'Insufficient privilege to perform this method.', PaycomException::ERROR_INSUFFICIENT_PRIVILEGE);
        }
    }

    private function checkPerformTransaction(): JsonResponse
    {
        $order = $this->orders->findOrderByOrderId($this->getValue($this->request->params['account']['order_id']));
        $order->validate($this->request->id, $this->request->params, $this->config);
        $paycom = PaycomTransaction::where('order_id', $order->id)->first();
        if ($paycom) {
            $paycom->checkAvailable($this->request->id);
        }
        return $this->response->send(['allow' => true]);
    }

    private function createTransaction()
    {
        $order = $this->orders->findOrderByOrderId($this->getValue($this->request->params['account']['order_id']));
        $order->validate($this->request->id, $this->request->params, $this->config);

        $paycom = PaycomTransaction::where('order_id', $order->id)->first();
        if ($paycom) {
            $paycom->checkAvailable($this->request->id);
            $paycom->checkPaycomTransaction($this->request->id, $this->request->params);
        }
        if ($paycom = $order->paycom) {
            if ($paycom->isCreated()) {
                $this->throwError('Transaction found, but is not active.', PaycomException::ERROR_COULD_NOT_PERFORM);
            } elseif ($paycom->isExpired()) {
                $this->cancel($paycom->id, PaycomTransaction::REASON_CANCELLED_BY_TIMEOUT);
                $this->throwError('Transaction is expired.', PaycomException::ERROR_COULD_NOT_PERFORM);
            }
            return $this->response->send([
                'create_time' => Format::datetime2timestamp($paycom->create_time),
                'transaction' => $paycom->id,
                'state' => $paycom->state,
                'receivers' => $paycom->receivers,
            ]);
        }

        if ($this->isExpired($this->request->params['time'])) {
            $this->throwError(
                PaycomException::message(
                    'С даты создания транзакции прошло ' . PaycomTransaction::TIMEOUT . 'мс',
                    'Tranzaksiya yaratilgan sanadan ' . PaycomTransaction::TIMEOUT . 'ms o`tgan',
                    'Since create time of the transaction passed ' . PaycomTransaction::TIMEOUT . 'ms'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'time'
            );
        }

        $createTime = Format::timestamp(true);

        try {
            $paycom = PaycomTransaction::create([
                'paycom_transaction_id' => $this->request->params['id'],
                'paycom_time' => $this->request->params['time'],
                'paycom_time_datetime' => Format::timestamp2datetime($this->request->params['time']),
                'create_time' => Format::timestamp2datetime($createTime),
                'amount' => $this->request->amount,
                'order_id' => $this->request->account('order_id'),
                'state' => PaycomTransaction::STATE_CREATED,
            ]);

            return $this->response->send([
                'create_time' => $createTime,
                'transaction' => $paycom->id,
                'state' => $paycom->state,
                'receivers' => null,
            ]);
        } catch (\DomainException|\RuntimeException $e) {
            $this->throwError($e->getMessage(), PaycomException::ERROR_INTERNAL_SYSTEM);
        }
    }

    private function checkTransaction()
    {
        $paycom = $this->orders->findTransaction($this->request->params['id'] ?? null);

        return $this->response->send([
            'create_time' => Format::datetime2timestamp($paycom->create_time),
            'perform_time' => Format::datetime2timestamp($paycom->perform_time),
            'cancel_time' => Format::datetime2timestamp($paycom->cancel_time),
            'transaction' => $paycom->id,
            'state' => $paycom->state,
            'reason' => $paycom->reason ?? null,
        ]);
    }

    private function performTransaction()
    {
        $paycom = $this->orders->findTransaction($this->request->params['id'] ?? null);

        switch ($paycom->state) {
            case PaycomTransaction::STATE_CREATED:
                if ($paycom->isExpired()) {
                    $this->cancel($paycom->id, PaycomTransaction::REASON_CANCELLED_BY_TIMEOUT);
                    $this->throwError('Transaction is expired.', PaycomException::ERROR_COULD_NOT_PERFORM);
                }

                $order = $paycom->order;
                $book = $order->book;
                $book->activate();

                $performTime = Format::timestamp(true);
                $paycom->pay($performTime);
                $order->pay();

                DB::beginTransaction();
                try {
                    $book->update();
                    $order->update();
                    $paycom->update();

                    DB::commit();
                    return $this->performResponse($paycom->id, $performTime, $paycom->state);
                } catch (\DomainException|\RuntimeException $e) {
                    DB::rollBack();
                    $this->throwError($e->getMessage(), PaycomException::ERROR_INTERNAL_SYSTEM);
                }
                break;
            case PaycomTransaction::STATE_COMPLETED:
                return $this->performResponse($paycom->id, Format::datetime2timestamp($paycom->perform_time), $paycom->state);
                break;
            default:
                $this->throwError('Could not perform this operation.', PaycomException::ERROR_COULD_NOT_PERFORM);
                break;
        }
    }

    private function performResponse($paycom_id, $perform_time, $state): JsonResponse
    {
        return $this->response->send([
            'transaction' => $paycom_id,
            'perform_time' => $perform_time,
            'state' => $state,
        ]);
    }

    private function cancelTransaction()
    {
        $paycom = $this->orders->findTransaction($this->request->params['id'] ?? null);

        switch ($paycom->state) {
            case PaycomTransaction::STATE_CANCELLED:
            case PaycomTransaction::STATE_CANCELLED_AFTER_COMPLETE:
                return $this->cancelResponse($paycom->id, $paycom->cancel_time, $paycom->state);
                break;
            case PaycomTransaction::STATE_CREATED:
                $this->cancel($paycom->id, $this->request->params['reason']);
                return $this->cancelResponse($paycom->id, $paycom->cancel_time, $paycom->state);
                break;
            case PaycomTransaction::STATE_COMPLETED:
                $order = $this->orders->findOrder($paycom->order_id);
                if ($order->allowCancel()) {
                    $this->cancel($paycom->id, $this->request->params['reason']);
                    return $this->cancelResponse($paycom->id, $paycom->cancel_time, $paycom->state);
                } else {
                    $this->throwError('Could not cancel transaction. Order is delivered/Service is completed.', PaycomException::ERROR_COULD_NOT_PERFORM);
                }
                break;
        }
    }

    private function cancel($id, $reason)
    {
        DB::beginTransaction();
        try {
            $paycom = $this->orders->findTransaction($id);
            $paycom->cancel($reason);
            $paycom->update();

            $order = $this->orders->findOrder($paycom->order_id);
            $order->cancel();
            $order->update();

            $book = $order->book;
            $book->cancel();
            $book->update();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function cancelResponse($id, $cancel_time, $state): JsonResponse
    {
        return $this->response->send([
            'transaction' => $id,
            'cancel_time' => Format::datetime2timestamp($cancel_time),
            'state' => $state,
        ]);
    }

    private function changePassword()
    {
        if (!isset($this->request->params['password']) || !trim($this->request->params['password'])) {
            $this->throwError('Could not cancel transaction. Order is delivered/Service is completed.', PaycomException::ERROR_INVALID_ACCOUNT, 'password');
        }

        if ($this->config['key'] == $this->request->params['password']) {
            $this->throwError('Could not cancel transaction. Order is delivered/Service is completed.', PaycomException::ERROR_INSUFFICIENT_PRIVILEGE);
        }

        if (!file_put_contents($this->config['keyFile'], $this->request->params['password'])) {
            $this->throwError('Internal System Error.', PaycomException::ERROR_INTERNAL_SYSTEM);
        }

        return $this->response->send(['success' => true]);
    }

    private function getStatement()
    {
        if (!isset($this->request->params['from'])) {
            $this->throwError('Incorrect period.', PaycomException::ERROR_INVALID_ACCOUNT, 'from');
        }

        if (!isset($this->request->params['to'])) {
            $this->throwError('Incorrect period.', PaycomException::ERROR_INVALID_ACCOUNT, 'to');
        }

        if (1 * $this->request->params['from'] >= 1 * $this->request->params['to']) {
            $this->throwError('Incorrect period. (from >= to)', PaycomException::ERROR_INVALID_ACCOUNT, 'from');
        }

        $report = $this->orders->report($this->request->params['from'], $this->request->params['to']);

        return $this->response->send(['transactions' => $report ?: []]);
    }

    private function isExpired($time): bool
    {
        return Format::timestamp2milliseconds(1 * $time) - Format::timestamp(true) >= PaycomTransaction::TIMEOUT;
    }

    private function throwError($message, $error, $data = null)
    {
        throw new PaycomException($this->request->id, $message, $error, $data);
    }

    private function getValue($value)
    {
        if (isset($value)) {
            return $value;
        }

        throw new \DomainException('Value is not isset.');
    }
}
