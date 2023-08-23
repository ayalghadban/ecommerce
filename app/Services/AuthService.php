<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    //register the user

    public  function register($request)
    {
        //create user
        $user = User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>$request->password,
        ]);

        //create token

        $token = $user->createToken('usertoken')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return $response;

    }

    //log in the user

    public  function loginUser($request)
    {
        //check email
        $user = User::where('email' , $request->email)->first();

        //check password

        if(!$user || !Hash::check($request->password,$user->password))
        {
            return 0;
        }

        // create token

       $token = $user->createToken('usertoken')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return $user;

    }

    // logout the user

    public function logoutUser($request)
    {
        auth()->user()->tokens()->delete();

        return 'logged out successfuly';
    }
}

