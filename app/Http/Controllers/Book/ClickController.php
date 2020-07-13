<?php

namespace App\Http\Controllers\Book;

use App\Exceptions\ClickException;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Services\Book\Click\ClickService;
use App\Validators\Book\ClickValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ClickController extends Controller
{
    private $service;
    private $accounts;
    private $validator;

    public function __construct(ClickService $service, ClickValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }


    ##################################################################################### Endpoints

    public function prepare(Request $request)
    {
        try {
            $result = $this->service->prepare($request);
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        } catch (\DomainException $e) {
            return json_encode($e->getMessage());
        } catch (\RuntimeException $e) {
            return json_encode(['error' => ClickValidator::UPDATE_FAILED, 'error_note' => 'Error in request from click']);
        }
    }

    public function complete(Request $request)
    {
        try {
            $result = $this->service->complete($request);
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        } catch (\DomainException $e) {
            return json_encode($e->getMessage());
        } catch (\RuntimeException $e) {
            return json_encode(['error' => ClickValidator::UPDATE_FAILED, 'error_note' => 'Error in request from click']);
        } catch (ClickException $e) {
            return json_encode(['error' => $e->getClickCode(), 'error_note' => $e->getMessage()]);
        }
    }

    #####################################################################################


    ##################################################################################### Subscribe API

    public function createOrder(BookRequest $request)
    {
        return $this->baseClickAction($request, function (BookRequest $request): JsonResponse {
            $this->validator->validateOrderCreate($request);
            $this->validator->validateAmount($request->amount);
            $user = Auth::user();

            $order = $this->service->createOrder($user->id, $request->doctor_id, $request->clinic_id, $request->booking_date, $request->time_start, $request->amount, $request->description);

            return $this->response(ResponseHelper::CODE_SUCCESS, 'Paycom order is created.', ['transaction_id' => $order->merchant_transaction_id]);
        });
    }

    public function createToken(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request): JsonResponse {
            $this->validator->validateAuth($request);
            $this->validator->validateCreateToken($request);
            $click = $this->service->createCardToken($request);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('Код смс отправляен на ваш телефон.'), ['card_token' => $request->card_token]);
        });
    }

    public function verifyToken(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request): JsonResponse {
            $this->validator->validateAuth($request);
            $this->validator->validateVerifyToken($request);
            $click = $this->service->verifyCardToken($request);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('Card is successfully verified.'));
        });
    }

    public function performOrder(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request): JsonResponse {
            $this->validator->validateAuth($request);
            $this->validator->validatePerformPayment($request);
            $click = $this->service->performPayment($request->card_token, $request->transaction_id);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('Payment is successfully performed.'), ['book_id' => $click->book_id]);
        });
    }

    public function checkPayment(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request) {
            $this->validator->validateAuth($request);
            $this->validator->validateCheckPayment($request);
            $click = $this->service->checkPayment($request);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('Payment is successfully performed.'), ['book_id' => $click->book_id]);
        });
    }

    #####################################################################################


    protected function baseClickAction(Request $request, callable $func): JsonResponse
    {
        try {
            return $func($request);
        } catch (ValidationException $e) {
            return $this->response(ResponseHelper::CODE_VALIDATION_ERROR, trans('validation.error'), $e->errorBag);
        }  catch (ClickException $e) {
            return $this->response($e->getCode(), $e->getMessage());
        } catch (\DomainException|\RuntimeException|\Exception $e) {
            return $this->response(ResponseHelper::CODE_ERROR, $e->getMessage());
        }
    }

    protected function response(int $code, string $message, $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

}
