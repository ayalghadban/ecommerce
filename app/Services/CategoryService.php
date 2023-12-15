<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class CategoryService
{
    // get all categories
    public function get_all_categories()
    {
        $all_categories = Category::all();
        return $all_categories;
    }

    //get one category
    public function get_one_category($request)
    {
        $one_category = Category::where('id', $request->category_id)->get();
        return $one_category;
    }

    //create new category
    public function create_category($request)
    {
        $new_category = Category::create([
            'name'  => $request->name,
            'image' => $request->image,
        ]);
        return $new_category;
    }

    //update category
    public function update_category($request)
    {
        $update = Category::where('id',$request->id)->update([
            'name'  => $request->name,
            'image' =>$request->image
        ]);
        $update = Category::where('id',$request->id)->get();
        return $update;
    }

    //delete category
    public function delete_category($request)
    {
        $delete = Category::where('id',$request->id)->delete();
        return true;
    }

    public function search($search_keyword)
    {
        $data = [];
        $products = Product::whereHas('category', function ($query) use ($search_keyword) {
            $query->where('name', $search_keyword);
        })->get();
        return $products;
    }

}
