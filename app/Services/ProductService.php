<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductTranslation;

class ProductService
{
    // get all products
    public function get_all_products()
    {
        $all_products = Product::with('translate1')->get();
        return $all_products;
    }

    //get one product
    public function get_one_product($request)
    {
        $one_product = Product::where('id', $request->product_id)->with('translate1')->get();
        return $one_product;
    }

    //create new product
    public function create_product($request,$translation)
    {
        $new_product = Product::create([
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'is_featured' => $request->is_featured
        ])->translate1()->create([
            'name' => $translation->name,
            'local' => $translation->local
        ]);
        $new_product = Product::where('image', $request->image)->with('translate1')->first();
        return $new_product;
    }

    //update product
    public function update_product($request,$translation,$id)
    {
        $update = Product::where('id',$id->product_id)
        ->update([
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'is_featured' => $request->is_featured
        ]);
        $update = ProductTranslation::where('product_id' ,$id->product_id)->update([
            'name' => $translation->name,
            'local' => $translation->local
        ]);
        $update =Product::where('id',$id->product_id)->with('translate1')->get();
        return $update;
    }

    //delete category
    public function delete_product($request)
    {
        $delete = Product::where('id',$request->id)->delete();
        return true;
    }

    //search products
    public function search_product($search_keyword)
    {
        $data = [];
        $product = Product::where('description', 'LIKE', '%' . $search_keyword . '%')->with('translate1')->get();
       /*$product =Product::whereHas("translate1",function ($query){
            $query->where('name', 'LIKE', '%' . $query . '%')->get();
        });*/
        $data = $product;

        return $data;
    }

}
