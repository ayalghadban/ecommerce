<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $_service ;

    public function __construct(CategoryService $service) {
        $this->_service = $service ;
    }
    public function getAllCategory(){

        $success = Category::all();
        return $this->sendResponse(__(''), $success);

    }
    public function getAllCategoryForDashBoard(Request $request){

        $success = [];
        $success['category'] = $this->_service->getAllCategoryForDashboard($request->level ??1 , $request->parent_id ?? 'no_filter');
        $success['subcategory'] = $this->_service->getAllCategoryForDashboard($request->level ??2 , $request->parent_id ?? 'no_filter');
        $success['subsubcategory'] = $this->_service->getAllCategoryForDashboard($request->level ??3 , $request->parent_id ?? 'no_filter');
        return $this->sendResponse(__(''), $success);

    }
}
