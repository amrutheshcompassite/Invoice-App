<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\ApiBaseController;
use App\Services\UserAPIServices;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

/**
 * Class UserAPIController
 * @package App\Http\Controllers\API
 */
class UserAPIController extends ApiBaseController
{
    protected $userAPIServices;
    public function __construct(UserAPIServices $userAPIServices)
    {
        $this->userAPIServices = $userAPIServices;
    }

    public function register()
    {
        $appinput = $this->getContent();
        $rules = $this->userAPIServices->userRegisterRules();
        $validator = Validator::make($appinput, $rules);
        if ($validator->fails()) {

            return $this
                ->setStatusCode(422)
                ->respond(false, $validator->errors());
        } else {
            $appinput['password'] = bcrypt($appinput['password']);
            $user = User::create($appinput);
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->first_name.' '.$user->last_name;
            
            return $this
                ->setStatusCode(200)
                ->setDataBag($success)
                ->respond(true, trans('login.new_user_created'));
        }
    }
}