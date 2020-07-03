<?php


namespace App\Http\Controllers\Book;


use App\Exceptions\ClickException;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Book\Click\ApplicationService;
use App\Services\Book\Click\ClickService;
use App\Validators\Book\ClickValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function endpoint(Request $request)
    {
        $application = new ApplicationService();
        $application->session($request);
    }

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

    public function createOrder(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request): JsonResponse {
            $this->validator->validateOrderCreate($request);
            $this->validator->validateAmount($request->amount);
            $account = $this->accounts->findActive($request->account_id);
            $order = $this->service->createOrderReceipt($request->amount, $account->id);

            return $this->response(ResponseHelper::CODE_SUCCESS, 'Paycom order is created.', ['order_id' => $order->id]);
        });
    }

    public function createToken(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request): JsonResponse {
            $this->validator->validateAuth($request);
            $this->validator->validateCreateToken($request);
            $click = $this->service->createCardToken($request);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('click.sms_sent_phone'), ['card_token' => $request->card_token,]);
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

    public function performPayment(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request): JsonResponse {
            $this->validator->validateAuth($request);
            $this->validator->validatePerformPayment($request);
            $click = $this->service->performPayment($request->card_token, $request->account_id);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('Payment is successfully performed.'), ['receipt_id' => $click->receipt_id]);
        });
    }

    public function checkPayment(Request $request)
    {
        return $this->baseClickAction($request, function (Request $request) {
            $this->validator->validateAuth($request);
            $this->validator->validateCheckPayment($request);
            $click = $this->service->checkPayment($request);

            return $this->response(ResponseHelper::CODE_SUCCESS, trans('Payment is successfully performed.'), ['receipt_id' => $click->receipt_id]);
        });
    }

    #####################################################################################

}
