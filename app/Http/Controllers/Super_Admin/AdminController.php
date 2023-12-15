<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\AdminRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public  function __construct (private AdminService  $service){
    }

    public function all()
    {
        $all_admins = $this->service->get_all_admins();
        return $this->sendResponse(__('messages.get_all_admins'),$all_admins);
    }
    // get one admin
    public function one($request)
    {
        $one_admin = $this->service->get_one_admin($request);
        return $this->sendResponse(__('messages.gat_one_admin'),$one_admin);
    }

    //create admin
    public function create(AdminRequest $request)
    {
        $new_admin = $this->service->create_admin($request);
        return $this-> sendResponse(__('messages.create_admin'),$new_admin);
    }

    //update admin
    public function update(AdminRequest $request)
    {
        $update = $this->service->update_admin($request);
        return $this-> sendResponse(__('messages.update_admin'),$update);
    }

    //delete admin
    public function delete(AdminRequest $request)
    {
        $delete = $this->service->delete_admin($request);
        return $this-> sendResponse(__('messages.delete_admin'),$delete);
    }


}
