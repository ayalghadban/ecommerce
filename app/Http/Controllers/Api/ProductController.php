<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AllProductsRequest;
use App\Http\Requests\Product\GetProductRequest;
use App\Http\Requests\Product\SearchProductsRequest;
use App\Services\ProductService;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService) {
        $this->productService = $productService ;
    }

    public function searchProduct(SearchProductsRequest $request)
    {

        $success = $this->productService->searchProduct($request->search_keyword);
        return $this->sendResponse('', $success);
    }

    public function allProducts(AllProductsRequest $request)
    {

        $success = $this->productService->allProducts($request->per_page, $request->search, $request->filter_category_id);
        return $this->sendResponse('', $success);
    }

    public function getProduct(GetProductRequest $request)
    {
        $success = $this->productService->getOne($request->product_id);
        return $this->sendResponse('', $success);
    }
}
