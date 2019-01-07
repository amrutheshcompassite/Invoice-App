<?php

namespace App\Services;

use App\Http\Controllers\API\ApiBaseController;
/**
 * Class UserAPIController
 * @package App\Http\Controllers\API
 */
class UserAPIServices extends  ApiBaseController
{
    public function __construct()
    {

    }

    public function userRegisterRules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required|regex:[^[0-9]*$]',
        ];
    }

}
