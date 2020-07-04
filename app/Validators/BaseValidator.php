<?php


namespace App\Validators;


use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseValidator
{
    protected function validate(Request $request, $rules, callable $callback = NULL)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            if ($callback !== NULL) {
                $callback($validator);
            }
            throw new ValidationException($validator, ResponseHelper::CODE_VALIDATION_ERROR, $validator->errors());
        }
    }
}
