<?php
namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    public  function __construct (private PermissionService  $service){
    }

    // get all Permissions
    public function all()
    {
        $all_Permissions = $this->service->get_all_permissions();
        return $this->sendResponse(__('messages.get_all_Permissions'),$all_Permissions);
    }

    // get one Permission
    public function one(PermissionRequest $request)
    {
        $one_Permission = $this->service->get_one_permission($request);
        return $this->sendResponse(__('messages.gat_one_Permission'),$one_Permission);
    }

    //create Permission
    public function create(PermissionRequest $request)
    {
        $new_Permission = $this->service->create_permission($request);
        return $this-> sendResponse(__('messages.create_Permission'),$new_Permission);
    }

    //update Permission
    public function update(PermissionRequest $request)
    {
        $update = $this->service->update_permission($request);
        return $this-> sendResponse(__('messages.update_Permission'),$update);
    }

    //delete Permission
    public function  delete(PermissionRequest $request)
    {
        $delete = $this->service->delete_permission($request);
        return $this-> sendResponse(__('messages.delete_Permission'),$delete);
    }
}
