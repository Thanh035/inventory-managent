<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns|max:100',
            'password' => 'required|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email address field is required.',
            'email.email' => 'The email address must be a valid email address',
            'email.max' => 'The email address field may not be greater than 100 characters.',
            'password.required' => 'The password field is required.',
            'password.max' => 'The password field may not be greater than 30 characters.',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(response()->json($this->validationFailedResponse($validator->errors()), Response::HTTP_UNPROCESSABLE_ENTITY));
//    }
}
