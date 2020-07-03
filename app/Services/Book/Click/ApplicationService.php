<?php

namespace App\Services\Book\Click;

use App\Helpers\ResponseHelper;
use App\Validators\Book\ClickValidator;
use App\Exceptions\ClickException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplicationService
{
    private $config;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $this->config = config('click');
    }

    public function session(Request $request)
    {
        try {
            $url = $request->getPathInfo();
            if ($request->hasHeader('X-Auth')) {
                if ($this->config['merchant_id'] . $this->config['service_id'] . $this->config['user_id'] !== $request->header('X-Auth')) {
                    throw new ClickException('Authorization error', ResponseHelper::CODE_VALIDATION_ERROR, ClickException::ERROR_INTERNAL_SYSTEM
                    );
                }

                return $this->requestHandler(new ClickService(), $request);
            } else if (in_array($url, ['/prepare', '/complete'])) {
                return $this->requestHandler(new ClickService(), $request);
            }
            throw new ClickException('Session could not perform without Auth token', ResponseHelper::CODE_ERROR,ClickException::ERROR_INTERNAL_SYSTEM
            );

        } catch (ClickException $e) {
            return json_encode($e->getError(), JSON_UNESCAPED_UNICODE);
        } catch (\DomainException $e) {
            return json_encode($e->getMessage());
        } catch (ValidationException $e) {
            return json_encode($e->errorBag);
        } catch (\RuntimeException $e) {
            return json_encode(['error' => ClickValidator::UPDATE_FAILED, 'error_note' => 'Error in request from click']);
        }
    }

    private function requestHandler(ClickService $service, Request $request)
    {
        switch ($request->getPathInfo()) {
            case '/prepare':
                return $this->response($service->prepare($request));
                break;
            case '/complete':
                return $this->response($service->complete($request));
                break;
            case '/payment':
                return $this->response($service->payment($request));
                break;
            case '/invoice/create':
                return $this->response($service->createInvoice($request));
                break;
            case '/invoice/check':
                return $this->response($service->checkInvoice($request));
                break;
            case '/payment/status':
                return $this->response($service->checkPayment($request));
                break;
            case '/payment/merchant_train_id':
                return $this->response($service->checkPaymentStatus($request));
                break;
            case '/cancel':
                return $this->response($service->cancel($request));
                break;
            case '/card/create':
                return $this->response($service->createCardToken($request));
                break;
            case '/card/verify':
                return $this->response($service->verifyCardToken($request));
                break;
            case '/card/payment':
                return $this->response($service->performPayment($request->card_token, $request->account_id));
                break;
            case '/card/delete':
                return $this->response($service->deleteCardToken($request));
                break;
            default:
                throw new ClickException('Incorrect request', ResponseHelper::CODE_ERROR, ClickException::ERROR_METHOD_NOT_FOUND);
                break;
        }
    }

    private function response($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
