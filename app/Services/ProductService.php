<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductTranslation;

class ProductService
{
    // get all products
    public function get_all_products()
    {
        $all_products = Product::all();
        return $all_products;
    }

    //get one product
    public function get_one_product($request)
    {
        $one_product = Product::where('id', $request->id)->get();
        return $one_product;
    }

    //create new product
    public function create_product($request)
    {
        $new_product = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
        ]);
        return $new_product;
    }

    //update product
    public function update_product($request)
    {
        $update = Product::where('id',$request->id)
        ->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
        ]);
        $update =Product::where('id',$request->id)->get();
        return $update;
    }

    //delete product
    public function delete_product($request)
    {
        $delete = Product::where('id',$request->id)->delete();
        return true;
    }

    //search products
    public function search_product_by_price($search_keyword)
    {
        $data = [];
        $product = Product::where('price', 'LIKE', '%' . $search_keyword . '%')->get();
        $data = $product;

        return $data;
    }

}
