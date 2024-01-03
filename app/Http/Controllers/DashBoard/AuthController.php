<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function adminLogin(AdminLoginRequest $request)
    {
        $success = AuthService::adminLogin($request->email, $request->password);

        if(!$success) {
            return $this->sendError(__('auth.wrong_credentials'), 401);
        }

        return $this->sendResponse(__('auth.login_success'), $success);
    }

    public function logout()
    {
        AuthService::logout();
        return $this->sendResponse(__('auth.logout_success'));
    }
}
