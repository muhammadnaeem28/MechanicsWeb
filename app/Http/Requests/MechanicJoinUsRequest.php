<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class MechanicJoinUsRequest extends Request
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
                    'fname' => 'required|min:1',
                    'lname' => 'required|min:1',
                    'email' => 'required|email|unique:users',
                    'zip' => 'required',
                    'phone' => 'required',
                ];
                break;
        }

    }
}
