<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterUserRequest;
use App\Http\Requests\DashBoard\User\UserRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct (private AuthService  $service){
    }

    //register user
    public function register(RegisterUserRequest $request)
    {
        $data = $this->service->register($request);

        if(!$data) {
            return $this->sendError(__('auth.register_error'));
        }
        return $this->sendResponse(__('auth.register_success'), $data);
    }

    //login user
    public function customerLogin(UserRequest $request)
    {
        $data = $this->service->loginUser($request);
        if($data == 'error')
            return $this->sendError(__('auth.wrong_credentials'));
        return $this->sendResponse(__('auth.login_success'), $data);
    }

    // logout user
    public function logout($request)
    {
        $data = $this->service->logoutUser($request);
        return $this->sendResponse(__('auth.logout_success'));
    }


}
