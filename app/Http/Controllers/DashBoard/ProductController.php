<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddProductRequest;
use App\Http\Requests\Product\AllProductsRequest;
use App\Http\Requests\Product\GetProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\UpdateProductStatusRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService){

        $this->productService = $productService;
    }

    public function all(AllProductsRequest $request)
    {
        $success = $this->productService->all($request->per_page , $request->search);
        return $this->sendResponse('', $success);
    }

    public function getProduct(GetProductRequest $request)
    {
        $success = $this->productService->getProduct($request->product_id);
        return $this->sendResponse('', $success);
    }

    public function addProduct(AddProductRequest $request)
    {
        $success = $this->productService->addProduct($request);
        return $this->sendResponse(__('messages.added_successfully'), $success);
    }

    public function updateProduct(UpdateProductRequest $request)
    {
        $success = $this->productService->updateProduct($request);
        return $this->sendResponse(__('messages.updated_successfully'), $success);
    }

    public function deleteProduct(Request $request)
    {
        $success = $this->productService->deleteProduct($request->product_id);
        return $this->sendResponse(__('messages.deleted_successfully'), $success);
    }

    public function updateProductStatus(UpdateProductStatusRequest $request)
    {
        $success = $this->productService->updateProductStatus($request->product_id, $request->new_status);
        return $this->sendResponse(__('messages.updated_successfully'), $success);
    }
    
}
