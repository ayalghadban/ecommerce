<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\Base\BaseCollection;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function allUser(Request $request){

        $users = User::where('email' ,null) ;

        $per_page = $request->per_page ?? 8;
        if(isset($request->search)){
            $users = $users->where('full_name' , $request->search);
        }
        
        $success = new BaseCollection($users->paginate($per_page));

        return $this->sendResponse(__('messages.updated_successfully'), $success);
        
    }

    public function deleteUser(UserRequest $request){


        $user =  User::find($request->user_id);

        $user->delete();

        return $this->sendResponse(__('messages.updated_successfully'), true);
    }
    public function updateUser(UserRequest $request){


        $user =  User::find($request->user_id);

        $user->full_name = $request->full_name;
        $user->phone = $request->phone;

        $user->save();
        return $this->sendResponse(__('messages.updated_successfully'), true);
    }
}
