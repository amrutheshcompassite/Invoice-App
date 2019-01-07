<?php

namespace App\Services;

use App\Http\Controllers\API\ApiBaseController;
/**
 * Class UserAPIController
 * @package App\Http\Controllers\API
 */
class UserAPIServices extends  ApiBaseController
{
    /**
     * UserAPIServices constructor.
     */
    public function __construct()
    {

    }

    /**
     * User registration rules
     * @return array
     */
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

    /**
     * User login rules
     * @return array
     */
    public function userLoginRules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

}
