<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    public static function getProfile($user_id)
    {
        $data = [];
        $data = User::where('id', $user_id)->first();

        return $data;
    }

    public static function updateUserInfo($user_id, $full_name = null, $email = null)
    {
        $user = User::where('id', $user_id)->first();

        if (isset($full_name)) {
            $user->full_name = $full_name;
        }

        if (isset($email)) {
            $user->email = $email;
        }

        $user->save();

        return [];
    }

    public static function updateUserPassword($user_id, $old_password, $new_password)
    {
        $user = User::where('id', $user_id)->first();

        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
        } else {
            return false;
        }

        $user->save();

        return true;
    }

    public static function deleteAccount($user_id)
    {
        $user = User::findOrFail($user_id);
        
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        $user->delete();
        return [];
    }

    // Account
    public static function all($per_page = 8, $search_keyword = null)
    {
        $data = [];

        $users = User::where('email', null);

        if ($search_keyword) {
            $users->where((function ($query) use ($search_keyword) {
                $query->where('full_name', 'LIKE', '%'.$search_keyword.'%')
                    ->orWhere('email', 'LIKE', '%'.$search_keyword.'%')
                    ->orWhere('phone', 'LIKE', '%'.$search_keyword.'%');
            }));
        }

        $data = $users->paginate($per_page);

        return $data;
    }
    
    public static function updateUserAddressByUser($user_id,$address_request, $order_id)
    {
        $user = User::where('id', $user_id)->first();
        $user_address = $user->address()->create($address_request);

        $user_address->order_id = $order_id;
        $user_address->save();
        
        return [];
    }
}
