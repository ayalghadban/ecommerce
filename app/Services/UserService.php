<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    // get all users
    public function get_all_users()
    {
        $all_users = User::where('email',null)->get();
        return $all_users;
    }

    //get one user
    public function get_one_user($request)
    {
        $user = User::where('id',$request->user_id)->get();
        return $user;

    }
    //create a new user
    public function create_user($request)
    {
        $new_user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $request->password
        ]);
        return $new_user;
    }

    //update a user
    public function update_user($request,$request_id)
    {
        $update = User::where('id',$request_id->user_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);
        $update = User::where('id',$request_id->user_id)->get();
        return $update;
    }

    //delete a user
    public function delete_user($request){
        $delete = User::where('id',$request->user_id)->delete();

        return true;
    }
}
