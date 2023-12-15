<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public  function __construct (private CategoryService  $service){
    }

    // get all categories
    public function get_all_categories()
    {
        $all_categories = $this->service->get_all_categories();
        return $this->sendResponse(__(''),$all_categories);
    }

    public function search( $request)
    {

        $success = $this->service->search($request->search_keyword);
        return $this->sendResponse('', $success);
    }

}
