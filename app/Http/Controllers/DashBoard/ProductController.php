<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\Product\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public  function __construct (private ProductService  $service){
    }

    // get all products
    public function all()
    {
        $all_products = $this->service->get_all_products();
        return $this->sendResponse(__('messages.get_all_products'),$all_products);
    }
    // get one product
    public function one_product(ProductRequest $request)
    {
        $one_product = $this->service->get_one_product($request);
        return $this->sendResponse(__('messages.gat_one_product'),$one_product);
    }

    //create product
    public function create(ProductRequest $request)
    {
        $new_product = $this->service->create_product($request);
        return $this-> sendResponse(__('messages.create_product'),$new_product);
    }

    //update product
    public function update(ProductRequest $request)
    {
        $update = $this->service->update_product($request);
        return $this-> sendResponse(__('messages.update_product'),$update);
    }

    //delete product
    public function  delete(ProductRequest $request)
    {
        $delete = $this->service->delete_product($request);
        return $this-> sendResponse(__('messages.delete_product'),$delete);
    }

}
