<?php

namespace App\Services;

use App\Http\Resources\Base\BaseCollection;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Services\BaseCrud\CrudService;
use Illuminate\Support\Facades\Http;

class CategoryService extends CrudService
{
    public function __construct(){
        parent::__construct(new Category());
    }

    public function getAllCategory($level , $parent_id){


        $data = new Category;

       $data =  $data->where('level' ,'=' , $level)->where('is_active' , true );

        if($parent_id != 'no_filter'){
            $data = $data->where('parent_id' , $parent_id);
        }
        return $data->with('categoryTranslations')->with('category')->get();

    }
    public function getAllCategoryForDashboard($level , $parent_id){


        $data = new Category;

       $data =  $data->where('level' ,'=' , $level);

        if($parent_id != 'no_filter'){
            $data = $data->where('parent_id' , $parent_id);
        }
        return $data->with('categoryTranslations')->with('category')->get();

    }


    public function AddTranslateToCategory(Category $category  , $data){

        $category->categoryTranslations()->create([
           "name" => $data['translated_fields']['1']['category_name'],
           'locale'=>'en'

        ]);
        $category->categoryTranslations()->create([
            "name" => $data['translated_fields']['2']['category_name'],
            'locale'=>'ar'

         ]);

         return $category;
        }

    public function UpdateTranslateToCategory(Category $category  , $data){


        $en   = $category->categoryTranslations()->where( 'locale'  ,'=','en')->first();
        $ar   = $category->categoryTranslations()->where( 'locale'  ,'=','ar')->first();
        $en->name = $data['translated_fields']['1']['category_name'];
        $ar->name = $data['translated_fields']['2']['category_name'];
        $en->save();
        $ar->save();
        return $category;
        }

}
