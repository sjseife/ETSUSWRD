<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'protectedEmail' => 'required_without:protectedPhoneNumber|email',
        ];
    }

    /**
     * Custom Error Message
     * @return array
     */
    public function messages()
    {
        $messages = ['protectedEmail.required_without' => 'The email or phone number field is required.'];
        return $messages;
    }
}
