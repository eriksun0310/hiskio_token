<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class APIRequest extends FormRequest
{
    // 覆蓋掉 FormRequest 的函式
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'error'=>$validator->errors()
        ], 400));
    }
}
