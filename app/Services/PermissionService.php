<?php
namespace App\Services;

use App\Models\Permission;

class PermissionService
{
        // get all permissions
        public function get_all_permissions()
        {
            $all_permissions = Permission::all();
            return $all_permissions;
        }

        //get one permission
        public function get_one_permission($request)
        {
            $one_permission = Permission::where('id', $request->id)->get();
            return $one_permission;
        }

        //create new permission
        public function create_permission($request)
        {
            $new_permission = Permission::create([
                'name' => $request->name,
            ]);
            return $new_permission;
        }

        //update permission
        public function update_permission($request)
        {
            $update = Permission::where('id',$request->id)
            ->update([
                'name' => $request->name,
            ]);
            $update =Permission::where('id',$request->id)->get();
            return $update;
        }

        //delete permission
        public function delete_permission($request)
        {
            $delete = Permission::where('id',$request->id)->delete();
            return true;
        }

}
