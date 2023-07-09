<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //unique:users :在user 這張table只能有一個email
        return [
            'name' => 'required | string',
            'email' => 'required | email | string | unique:users',
            'password' => 'required | string | confirmed'
        ];
    }
}
