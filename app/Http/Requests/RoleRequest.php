<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleRequest extends Request
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
        foreach($this->request->get('role') as $key => $val)
        {
            $rules['role.'.$key] = 'unique:roles,name,'.$key;
        }

        return $rules;
    }

    /**
     * Custom Error Message
     * @return array
     */
    public function messages()
    {
        $messages = [];
        foreach($this->request->get('role') as $key => $val)
        {
            $messages['role.'.$key.'.unique'] = 'The role named "'.$val.'" is not unique!';
        }
        return $messages;
    }
}
