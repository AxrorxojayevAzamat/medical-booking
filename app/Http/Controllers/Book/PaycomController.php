<?php


namespace App\Http\Controllers\Book;

use App\Entity\Book\Payment\PaycomOrder;
use App\Entity\User\User;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Services\Book\Paycom\PaycomService;
use App\Services\Book\Paycom\ApplicationService;
use App\Validators\Book\PaycomValidator;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class PaycomController extends Controller
{
    private $service;
    private $validator;

    public function __construct(PaycomService $service, PaycomValidator $validator)
    {
        require_once __DIR__ . '/../../../Helpers/helpers.php';

        $this->service = $service;
        $this->validator = $validator;
    }

    public function test()
    {
        return response()->json(['message' => 'success']);
    }

    public function endpoint()
    {
        require_once __DIR__ . '/../../../Helpers/functions.php';

        $application = new ApplicationService();
        return $application->run();
    }

    public function createOrder(BookRequest $request)
    {
        try {
            $this->validator->authorizePaycom($request);
            $this->validator->validateOrderCreate($request);
            $this->validator->validateAmount($request->amount);
            $user = Auth::user();
        } catch (ValidationException $e) {
            return $this->response(ResponseHelper::CODE_VALIDATION_ERROR, trans('validation.error'), $e->errorBag);
        } catch (Exception $e) {
            return $this->response(ResponseHelper::CODE_ERROR, $e->getMessage());
        }

        try {
            $order = $this->service->createBookOrder($user->id, $request->amount); // TODO fix order creation
            return $this->successResponse('Paycom order is created.', ['order_id' => $order->id]);
        } catch (RuntimeException $e) {
            return $this->response(ResponseHelper::CODE_ERROR, $e->getMessage());
        }
    }

    public function performOrder(Request $request)
    {
        try {
            $this->validator->validateReceiptPerform($request);
            $token = $request->token;
            $order = PaycomOrder::find($request->order_id);
            $this->service->checkCard($token);
            $this->service->lockOrder($order);
            $data = $this->service->createReceipt($order->id, $order->amount);
            $this->service->unlockOrder($order);
            $this->service->checkRequestReceiptsCreate($data);
            $data = $this->service->payReceipt($data->result->receipt->_id, $token);

            return $this->successResponse('Payment is successfully performed.', ['transaction_id' => $order->receipt_id]);
        } catch (ValidationException $e) {
            return $this->response(ResponseHelper::CODE_VALIDATION_ERROR, trans('validation.error'), $e->errorBag);
        } catch (RuntimeException|Exception $e) {
            return $this->response(ResponseHelper::CODE_ERROR, $e->getMessage());
        }
    }

    private function successResponse(string $message, $data = []): JsonResponse
    {
        return$this->response(ResponseHelper::CODE_SUCCESS, $message, $data);
    }

    private function response(int $code, string $message, $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
