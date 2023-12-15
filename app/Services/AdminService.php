<?php
namespace App\Services;

use App\Models\Admin;

class AdminService
{
    public function get_all_admins()
    {
        $admins = Admin::all();
        return $admins;
    }

    public function get_one_admin($id)
    {
        $admin = Admin::where('id', $id)->get();
        return $admin;
    }

    public function create_admin($request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);
        return $admin;
    }

    public function update_admin($request)
    {
        $admin = Admin::where('id', $request->id)->get();
        $new = $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);
        return $new;
    }

    public function delete_admin($request)
    {
        $delete = Admin::where('id', $request->id)->delete();
        return true;
    }
}
