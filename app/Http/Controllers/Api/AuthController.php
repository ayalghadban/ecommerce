<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CustomerLoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendCodeRequest;
use App\Http\Requests\Auth\VerifiedRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $success = AuthService::customerRegister($request);

        if(!$success) {
            return $this->sendError(__('auth.failed_code_sent'), 401);
        }

        return $this->sendResponse(__('auth.verify_code'), $success);
    }

    public function customerLogin(CustomerLoginRequest $request)
    {
        $success = AuthService::customerLogin($request->phone, $request->password);

        if($success == 1) {
            return $this->sendError( __('auth.can_not_login'), 402);
        } elseif($success == 2) {
            return $this->sendError( __('auth.wrong_credentials'), 400);
        }

        return $this->sendResponse(__('auth.login_success'), $success);
    }

    public function logout()
    {
        AuthService::logout();
        return $this->sendResponse(__('auth.logout_success'));
    }
}
