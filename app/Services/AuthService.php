<?php

namespace App\Services;

use App\Mail\ContactUs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthService
 * @package App\Services
 */

class AuthService
{
    public static function customerRegister($request)
    {

        if ($request) {
            $user = User::create([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $success['full_name'] = $user->full_name;
            $success['phone'] = $user->phone;
            //$success['token'] = $user->createToken('ayagh123',['costumer-api'])->plainTextToken;
            return $success;
        } else {
            return false;
        }
    }

    public static function customerLogin($phone, $password)
    {
        $credentials = ["phone"=>$phone, "password"=>$password];

        $user = User::where('phone', $phone)->first();

        if (auth()->attempt($credentials)) {

            if ($user) {
                $success['token'] = $user->createToken('ayagh123', ['customer-api'])->plainTextToken;
                $success['user'] = $user;
                $success['role'] = "customer";
                return $success;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }

    public static function adminLogin($email, $password)
    {

        $credentials = ["email"=>$email, "password"=>$password];

        $user = User::where('email', $email)->first();

        if (auth()->attempt($credentials)) {

            $success['token'] = $user->createToken('MyApp', ['admin-api'])->plainTextToken;
            $success['user'] = $user;
            $success['user']['role_type'] = "admin";
            return $success;
        } else {
            return false;
        }
    }

    public static function logout()
    {
        auth()->user()->tokens()->delete();
    }
}
