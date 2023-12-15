<?php
namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Super_Admin\SuperAdminRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct (private AuthService  $service){
    }

    public function login_super_admin($request)
    {
        $data = $this->service->loginAdmin($request);
        if($data == 0)
            return $this->sendError(__('auth.wrong_credentials'));
        return $this->sendResponse(__('auth.login_success'), $data);
    }

    public function logout($request)
    {
        $data = $this->service->logoutUser($request);
        if($data == 0)
        {
            return $this->sendError(__('auth.logout_error'));
        }
        else
        return $this->sendResponse(__('auth.logout_success'));
    }

}
