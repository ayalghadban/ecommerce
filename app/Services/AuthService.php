<?php
namespace App\Services;

use App\Http\Requests\Super_Admin\SuperAdminRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Tymon\JWTAuth\Facades\JWTAuth;


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

        if(!$user || !($request->password === $user->password))
        {
            return 'error';
        }

        // create token

       $token = $user->createToken('usertoken',['api-user'])->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return $user;

    }

    // logout the user

    public function logoutUser($request)
    {
        auth()->user()->tokens()->delete();

        return true;
    }

    public function loginAdmin(SuperAdminRequest $request)
    {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = FacadesValidator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);

            if (!$token)
                return false;

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            //return token
            return $admin;
    }

    public function logout($request)
    {
         $token = $request -> header('auth-token');
        if($token){
            if(JWTAuth::setToken($token)->invalidate()) //logout
                return false;
            else
                return true;
        }else{
            return false;
        }
    }
}

