<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\Category\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    public  function __construct (private CategoryService  $service){
    }

    // get all categories
    public function all()
    {
        $all_categories = $this->service->get_all_categories();
        return $this->sendResponse(__('messages.get_all_categories'),$all_categories);
    }
    // get one category
    public function one_category(CategoryRequest $request)
    {
        $one_category = $this->service->get_one_category($request);
        return $this->sendResponse(__('messages.gat_one_category'),$one_category);
    }

    //create categgory
    public function create(CategoryRequest $request,)
    {
        $new_category = $this->service->create_category($request);
        return $this-> sendResponse(__('messages.create_category'),$new_category);
    }

    //update category
    public function update_category(CategoryRequest $request)
    {
        $update = $this->service->update_category($request);
        return $this-> sendResponse(__('messages.update_category'),$update);
    }

    //delete category
    public function  delete_category(CategoryRequest $request)
    {
        $delete = $this->service->delete_category($request);
        return $this-> sendResponse(__('messages.delete_category'),$delete);
    }


}
