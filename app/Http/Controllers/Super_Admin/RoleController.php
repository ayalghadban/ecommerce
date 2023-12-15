<?php
namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;

class RoleController extends Controller
{
    public  function __construct (private RoleService  $service){
    }

    // get all roles
    public function all()
    {
        $all_roles = $this->service->get_all_roles();
        return $this->sendResponse(__('messages.get_all_roles'),$all_roles);
    }

    // get one role
    public function one(RoleRequest $request)
    {
        $one_role = $this->service->get_one_role($request);
        return $this->sendResponse(__('messages.gat_one_role'),$one_role);
    }

    //create role
    public function create(RoleRequest $request)
    {
        $new_role = $this->service->create_role($request);
        return $this-> sendResponse(__('messages.create_role'),$new_role);
    }

    //update role
    public function update(RoleRequest $request)
    {
        $update = $this->service->update_role($request);
        return $this-> sendResponse(__('messages.update_role'),$update);
    }

    //delete role
    public function  delete(RoleRequest $request)
    {
        $delete = $this->service->delete_role($request);
        return $this-> sendResponse(__('messages.delete_role'),$delete);
    }
}
