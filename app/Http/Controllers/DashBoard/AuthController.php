<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterUserRequest;
use App\Services\AuthService;

class AuthController extends Controller
{

    public  function __construct (private AuthService  $service){
    }

    // register user
    public function Register(RegisterUserRequest $request)
    {
        $data = $this->service->register($request);
        if(!$data)
            return $this->sendError(__('auth.register_error'));

        return $this->sendResponse(__('auth.register_success'), $data);
    }

    //login function
    public function Login(LoginRequest $request)
    {
        $data = $this->service->loginUser($request);
        //0 = email or password is wrong
        if($data == 0)
            return $this->sendError(__('auth.wrong_credentials'));

        return $this->sendResponse(__('auth.login_success'), $data);
    }

    // log out function

    public function Logout(RegisterUserRequest $request) : string
    {
        $data = $this->service->logoutUser($request);

        return $data;

    }
}
