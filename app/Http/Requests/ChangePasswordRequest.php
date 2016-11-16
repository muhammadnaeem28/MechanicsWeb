<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
        switch($this->method()) {
            case 'POST':
                return [
                    'current_password' => 'required',
                    'password' => 'required|min:5|confirmed',
                    'password_confirmation' => 'required|min:5'


                ];
                break;

            case 'PATCH':
                return [
                    'current_password' => 'required',
                    'password' => 'required|min:5|confirmed',
                    'password_confirmation' => 'required|min:5'
                ];
                break;
        }

    }
}
