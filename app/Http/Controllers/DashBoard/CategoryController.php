<?php
declare(strict_types=1);
namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAddRequest;
use App\Http\Requests\Category\CategoryGetRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private   CategoryService $_service ;

    public function __construct(CategoryService $service){
        $this->_service = $service ;
    }
    public function get_all_categories(Request $request)
    {
        $success=[];
        $success['category'] = $this->_service->getAllCategoryForDashboard($request->level ??1 , $request->parent_id ?? 'no_filter');

        return $this->sendResponse('', $success);

    }
    public function add_category(CategoryAddRequest $request)
    {
        $img = ImageService::upload_image($request->file('category_image') , '/category');
        $category_data = [
                ...$request->validated(),
                "category_image" => $img
            ];

        $category = $this->_service->create($category_data);

        $category = $this->_service->AddTranslateToCategory($category ,   $request->validated());

        return $this->sendResponse(__('messages.added_successfully'), $category);
    }

    public function update_category(CategoryUpdateRequest $request)
    {

        $category_data = [
                ...$request->validated(),

        ];
        if($request->hasFile('category_image')){
                $img = ImageService::upload_image($request->file('category_image') , '/category');
                $category_data = [
                        ...$category_data ,
                        'category_image'=>$img
                ];
        }else{
                // remove image if not file from object
                unset($category_data['category_image']);

        }
        $category = $this->_service->edit($request->category_id,$category_data);
        $category = $this->_service->UpdateTranslateToCategory($category ,   $request->validated());
         return $this->sendResponse(__('messages.updated_successfully'), $category);
    }

    public function delete_category(CategoryGetRequest $request)
    {

        $success = $this->_service->delete($request->category_id);

        return $this->sendResponse(__('messages.deleted_successfully'), $success);
    }

    public function update_category_status(CategoryGetRequest $request)
    {

        $success = $this->_service->update_status($request->category_id , $request->new_status);
        return $this->sendResponse(__('messages.updated_successfully'), $success);

    }

}

