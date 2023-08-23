<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryTranslation;

class CategoryService
{
    // get all categories
    public function get_all_categories()
    {
        $all_categories = Category::with('translate')->get();
        return $all_categories;
    }

    //get one category
    public function get_one_category($request)
    {
        $one_category = Category::where('id', $request->category_id)->with('translate')->get();
        return $one_category;
    }

    //create new category
    public function create_category($request,$translation)
    {
        $new_category = Category::create([
            'image' => $request->image,
        ])->translate()->create([
            'category_id' => $translation->category_id,
            'name' => $translation->name,
            'local'=>$translation->local,
        ]);
        $new_category = Category::where('image', $request->image)->with('translate')->get();
        return $new_category;
    }

    //update category
    public function update_category($request,$translation,$id)
    {
        $update = Category::where('id',$id->category_id)
        ->update(['image' =>$request->image]);
        $update = CategoryTranslation::where('category_id' ,$id->category_id)->update([
            'name' => $translation->name,
            'local'=>$translation->local,
        ]);
        $update = Category::where('id',$id->category_id)->with('translate')->get();
        return $update;
    }

    //delete category
    public function delete_category($request)
    {
        $delete = Category::where('id',$request->id)->delete();
        return true;
    }

}
