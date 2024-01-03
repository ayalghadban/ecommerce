<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdatePasswordRequest;
use App\Http\Requests\Account\UpdateProfileRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService ;

    public function __construct(UserService $userService) {
        $this->userService = $userService ;
    }

    public function getProfile()
    {
        $user = auth()->user();
        $success['user'] = $this->userService->getProfile($user->id);

        return $this->sendResponse('', $success);

    }

    public function updateUserInfo(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $success = $this->userService->updateUserInfo($user->id, $request->full_name, $request->email);

        return $this->sendResponse(__('messages.updated_successfully'), $success);
    }

    public function updateUserPassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        $success = $this->userService->updateUserPassword($user->id, $request->old_password, $request->new_password);

        if (!$success) {
            return $this->sendError(__('messages.wrong_old_password'), 400);
        } else {
            return $this->sendResponse(__('messages.updated_successfully'), $success);
        }
    }

    public function deleteUserAccount()
    {
        $user = auth()->user();

        $success = $this->userService->deleteAccount($user->id);
        return $this->sendResponse(__('messages.account_deleted_sucsessfully'), $success);
    }
}
