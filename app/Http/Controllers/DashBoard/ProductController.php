<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\Product\GetProductRequest;
use App\Http\Requests\DashBoard\Product\ProductRequest;
use App\Http\Requests\DashBoard\Product\TranslationProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public  function __construct (private ProductService  $service){
    }

    // get all products
    public function get_all_products()
    {
        $all_products = $this->service->get_all_products();
        return $this->sendResponse(__('messages.get_all_products'),$all_products);
    }
    // get one product
    public function get_one_product(GetProductRequest $request)
    {
        $one_product = $this->service->get_one_product($request);
        return $this->sendResponse(__('messages.gat_one_product'),$one_product);
    }

    //create product
    public function create_product(ProductRequest $request,TranslationProductRequest $translation)
    {
        $new_product = $this->service->create_product($request,$translation);
        return $this-> sendResponse(__('messages.create_product'),$new_product);
    }

    //update product
    public function update_product(ProductRequest $request,TranslationProductRequest $translation, GetProductRequest $id)
    {
        $update = $this->service->update_product($request,$translation,$id);
        return $this-> sendResponse(__('messages.update_product'),$update);
    }

    //delete product
    public function  delete_product(GetProductRequest $request)
    {
        $delete = $this->service->delete_product($request);
        return $this-> sendResponse(__('messages.delete_product'),$delete);
    }

}
