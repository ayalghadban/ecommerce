<?php

namespace App\Services;

use App\Http\Resources\Base\BaseCollection;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Services\BaseCrud\CrudService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends CrudService
{
    public function __construct(){
        parent::__construct(new Product());
    }

    public static function allProducts($per_page, $search_keyword, $filter_category_id )
    {
        $data = [];
        $per_page = isset($per_page)? $per_page : 8;

        $products = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->where('products.is_active', true)->where('categories.is_active', true)->where('products.product_quantity', '!=', 0)
        ->with('productTranslations')
        ->select('products.id' ,'category_id' ,'product_price' ,'product_quantity' ,'product_main_image');

        if (isset($search_keyword)) {

            $products->whereHas('productTranslations' , function($query) use($search_keyword){
                $query->where('name' , 'LIKE', '%' . $search_keyword . '%');
            });
        }

        if (isset($filter_category_id)) {
            $products->where('products.category_id', $filter_category_id);
        }

        $data = new BaseCollection($products->paginate($per_page));

        return $data;
    }

    public static function searchProduct($search_keyword)
    {
        $data = [];

        $products = Product::where('is_active', true)
        ->join('product_translations', 'product_translations.product_id', '=', 'products.id')->with('images', 'category')
        ->select('products.id', 'products.product_main_image','product_translations.name', 'product_translations.description', 'products.product_price')
        ->where('product_translations.name', 'LIKE', '%' . $search_keyword . '%')
        ->orWhere('product_translations.description', 'LIKE', '%' . $search_keyword . '%')->get();


        $data = $products;

        return $data;
    }

    public  function getOne($product_id, $relation = null)
    {
        $product = Product::where('id', $product_id)->where('is_active', true)
        ->with('productTranslations', 'images', 'category')->first();
        return $product;
    }



    // Dashboard Product Services

    public static function all($per_page = 8 ,$search_keyword =null)
    {
        $data = [];

        $products = Product::with('productTranslations');

        if (isset($search_keyword)) {
            $products->whereHas('productTranslations' , function($query) use($search_keyword){
                $query->where('name', 'LIKE', '%'. $search_keyword. '%');
            });
        }
        $data = new BaseCollection($products->paginate($per_page));

        return $data;
    }

    public  function allProductsForDashBoard($per_page, $search_keyword, $category_filter)
    {
        $data = [];

        $per_page = isset($per_page)? $per_page : 8;

            $products = Product::where('is_active' ,true)->with('category');
       ;

        if (isset($search_keyword)) {
            $products->whereHas('productTranslations' , function($query) use($search_keyword){
                $query->where('name', 'LIKE', '%'. $search_keyword. '%');
            });
        }

        if (isset($category_filter)) {
            $products->where('products.category_id', $category_filter);
        }

        $data = new BaseCollection($products->paginate($per_page));

        return $data;
    }

    public static function getProduct($product_id)
    {

        $product = Product::where('id', $product_id)->
        with('productTranslations', 'images', 'category.categoryTranslations')->first();



        $product_category_id = $product->category_id ;


        $category_id = null;
        $subcategory_id = null;
        $subsubcategory_id = null;

       $category = Category::find($product_category_id);


       if($category->level ==3){
        $subsubcategory_id = $product_category_id;
        $subcategory_id = $category->parent_id;
        $category_id=Category::find($category->parent_id)->parent_id ;
       }
       else if($category->level ==2){
        $subcategory_id = $product_category_id;
        $category_id=$category->parent_id ;
       }
       else {
        $category_id = $product_category_id ;
       }



       $product['category_id']  = $category_id ;
       $product['subcategory_id']  = $subcategory_id ;
       $product['subsubcategory_id']  = $subsubcategory_id ;
        return $product;
    }

    public static function addProduct($request)
    {
        if (isset($request->product_main_image)) {
            $product_main_image = ImageService::upload_image($request->file('product_main_image'), 'product');
        } else {
            $product_main_image = null;
        }

        $prouct = Product::create([
            'category_id' => $request->category_id,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_main_image' => $product_main_image,
            "is_highlight"=> $request->is_highlight,
            "is_latest"=> $request->is_latest,
        ]);


        $prouct->productTranslations()->create([
            'name' => $request->ar_product_name,
            'description' => $request->ar_product_description,
            'locale' => 'ar',
        ]);

        $prouct->productTranslations()->create([
            'name' => $request->en_product_name,
            'description' => $request->en_product_description,
            'locale' => 'en',
        ]);

        $prouct->save();

        return [];
    }

    public static function updateProduct($request)
    {
        $product = Product::where('id', $request->product_id)->first();

        if (isset($request->product_main_image)) {
            if (isset($product->product_main_image)) {
                $product->product_main_image = ImageService::update_image($request->file('product_main_image'), $product->product_main_image, 'product');
            } else {
                $product->product_main_image =ImageService::upload_image($request->file('product_main_image'), 'product');
            }
        }

        $product->category_id = isset($request->category_id) ? $request->category_id : $product->category_id;
        $product->product_price = isset($request->product_price) ? $request->product_price : $product->product_price;
        $product->product_quantity = isset($request->product_quantity) ? $request->product_quantity : $product->product_quantity;
        $product->is_highlight = isset($request->is_highlight) ? $request->is_highlight : $product->is_highlight;
        $product->is_most_purchase = $request->is_most_purchase ;
        $product->is_cheapest =  $request->is_cheapest ;
        $product->is_latest =  $request->is_latest ;

        $ar_translation = $product->productTranslations()->where('locale', 'ar')->first();
        $ar_translation->name = isset($request->ar_product_name) ? $request->ar_product_name : $ar_translation->name;
        $ar_translation->description = isset($request->ar_product_description) ? $request->ar_product_description : $ar_translation->description;
        $ar_translation->save();

        $en_translation = $product->productTranslations()->where('locale', 'en')->first();
        $en_translation->name = isset($request->en_product_name) ? $request->en_product_name : $en_translation->name;
        $en_translation->description = isset($request->en_product_description) ? $request->en_product_description : $en_translation->description;
        $en_translation->save();

        $product->save();

        return [];
    }

    public static function deleteProduct($product_id)
    {
        $product = Product::find($product_id);

        ImageService::delete_image($product->product_main_image);
        $product->delete();

        return [];
    }

    public static function updateProductStatus($product_id, $new_status)
    {
        $product = Product::where('id', $product_id)->first();

        if (isset($new_status)) {
            $product->is_active = $new_status == 'false' ? 0 : 1;
            $product->save();
        }

        return [];
    }

    // public static function updateProductImages()
    // {
    // }
}
