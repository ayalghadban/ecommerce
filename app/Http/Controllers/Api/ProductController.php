<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\SearchProductsRequest;
use App\Http\Requests\DashBoard\Product\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct (private ProductService  $service){
    }

    //search products
    public function search_product(SearchProductsRequest $request)
    {

        $success = $this->service->search_product_by_price($request->search_keyword);
        return $this->sendResponse('', $success);
    }

    //get one product
    public function get_product(ProductRequest $request)
    {
        $success = $this->service->get_one_product($request);
        return $this->sendResponse('', $success);
    }
}
