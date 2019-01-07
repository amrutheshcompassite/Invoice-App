<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\ApiBaseController;
use App\Services\UserAPIServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


/**
 * Class UserAPIController
 * @package App\Http\Controllers\API
 */
class UserAPIController extends ApiBaseController
{
    protected $userAPIServices;

    /**
     * UserAPIController constructor.
     * @param UserAPIServices $userAPIServices
     */
    public function __construct(UserAPIServices $userAPIServices)
    {
        $this->userAPIServices = $userAPIServices;
    }

    /**
     * User registration
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * User login
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $appinput = $this->getContent();
        $rules = $this->userAPIServices->userLoginRules();

        $validator = Validator::make($appinput, $rules);
        if ($validator->fails()) {
            return $this
                ->setStatusCode(422)
                ->setDataBag($validator->errors()->toArray());
        }
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->first_name.' '.$user->last_name;

            return $this
                    ->setStatusCode(200)
                    ->setDataBag($success)
                    ->respond(true, trans('login.log_in'));
        }
        else{
            return $this
                ->setStatusCode(401)
                ->respond(true, trans('login.invalid_credentials'));
        }
    }
}