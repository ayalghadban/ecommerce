<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\User\GetUserRequest;
use App\Http\Requests\DashBoard\User\UserRequest ;
use App\Services\UserService;
class UserController extends Controller
{
    public  function __construct (private UserService  $service){
    }

    //get all users
    public function all()
    {
        $all_users = $this->service->get_all_users();
        return $this->sendResponse(__('messages.get_user_successfully'), $all_users);

    }

    //get one user
    public function one_user(GetUserRequest $request)
    {
        $user = $this->service->get_one_user($request);

        return $this->sendResponse(__('messages.get_user_successfully'), $user);
    }

    //create a new user
    public function create(UserRequest $request)
    {
        $new_user = $this->service->create_user($request);

        return $this->sendResponse(__('messages.created_successfully'), $new_user);
    }

    // update a user
    public function update(UserRequest $request,GetUserRequest $request_id)
    {
        $update = $this->service->update_user($request,$request_id);

        return $this->sendResponse(__('messages.updated_successfully'), $update);
    }

    //delete a user
    public function delete(GetUserRequest $request)
    {
        $delete = $this->service->delete_user($request);

        return $this->sendResponse(__('messages.deleted_successfully'), $delete);
    }
}
/*
    $category = Categroy
*/
