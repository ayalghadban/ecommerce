<?php
namespace App\Services;

use App\Models\SubCategory;

class SubCategoryService
{
    // get all sub categories
    public function get_all_sub_categories()
    {
        $all_sub_categories = SubCategory::all();
        return $all_sub_categories;
    }

    //get one sub category
    public function get_one_sub_category($request)
    {
        $one_sub_category = SubCategory::where('id', $request->category_id)->get();
        return $one_sub_category;
    }

    //create new sub category
    public function create_sub_category($request)
    {
        $new_category = SubCategory::create([
            'name'  => $request->name,
            'image' => $request->image,
            'category_id' => $request->category_id,
        ]);
        return $new_category;
    }

    //update sub category
    public function update_sub_category($request)
    {
        $update = SubCategory::where('id',$request->id)->update([
            'name'  => $request->name,
            'image' =>$request->image,
            'category_id' => $request->category_id,
        ]);
        $update = SubCategory::where('id',$request->id)->get();
        return $update;
    }

    //delete sub category
    public function delete_sub_category($request)
    {
        $delete = SubCategory::where('id',$request->id)->delete();
        return true;
    }
}
