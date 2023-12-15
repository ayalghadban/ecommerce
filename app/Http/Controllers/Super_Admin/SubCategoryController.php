<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\Category\CategoryRequest;
use App\Http\Requests\DashBoard\Category\GetCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Services\SubCategoryService;

class SubCategoryController extends Controller
{

    public  function __construct (private SubCategoryService  $service){
    }

    // get all categories
    public function all()
    {
        $all_categories = $this->service->get_all_sub_categories();
        return $this->sendResponse(__('messages.get_all_categories'),$all_categories);
    }
    // get one category
    public function one(SubCategoryRequest $request)
    {
        $one_category = $this->service->get_one_sub_category($request);
        return $this->sendResponse(__('messages.gat_one_category'),$one_category);
    }

    //create categgory
    public function create(SubCategoryRequest $request)
    {
        $new_category = $this->service->create_sub_category($request);
        return $this-> sendResponse(__('messages.create_category'),$new_category);
    }

    //update category
    public function update(SubCategoryRequest $request)
    {
        $update = $this->service->update_sub_category($request);
        return $this-> sendResponse(__('messages.update_category'),$update);
    }

    //delete category
    public function  delete(SubCategoryRequest $request)
    {
        $delete = $this->service->delete_sub_category($request);
        return $this-> sendResponse(__('messages.delete_category'),$delete);
    }


}
