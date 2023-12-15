<?php
namespace App\Services;

use App\Models\Role;

class RoleService
{
        // get all roles
        public function get_all_roles()
        {
            $all_roles = Role::all();
            return $all_roles;
        }

        //get one role
        public function get_one_role($request)
        {
            $one_role = Role::where('id', $request->id)->get();
            return $one_role;
        }

        //create new role
        public function create_role($request)
        {
            $new_role = Role::create([
                'name' => $request->name,
            ]);
            return $new_role;
        }

        //update role
        public function update_role($request)
        {
            $update = Role::where('id',$request->id)
            ->update([
                'name' => $request->name,
            ]);
            $update =Role::where('id',$request->id)->get();
            return $update;
        }

        //delete role
        public function delete_role($request)
        {
            $delete = Role::where('id',$request->id)->delete();
            return true;
        }

}
