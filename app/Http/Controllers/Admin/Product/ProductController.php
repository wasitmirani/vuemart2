<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use App\Helpers\Component;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\SubCategoryCollection;

class ProductController extends Controller
{
    //

    protected $imageArray = [];

    public function index()
    {
        $query = request('query');
        $products = Product::orderBy('name', 'ASC')
            ->where('name', 'like', '%' . $query . '%')
            ->orwhere('quantityPerUnit', 'like', '%' . $query . '%')
            ->orwhere('unitsInStock', 'like', '%' . $query . '%')
            ->orwhere('actualPrice', 'like', '%' . $query . '%')
            ->orwhere('unitPrice', 'like', '%' . $query . '%')
            ->orwhere('discount_price', 'like', '%' . $query . '%')
            ->orwhereHas('category', function ($q) use ($query) {
                return $q->where('name', 'like', '%' . $query . '%');
            })->orwhereHas('subcategory', function ($q) use ($query) {
                return $q->where('name', 'like', '%' . $query . '%');
            })->with(['productImages', 'category', 'subcategory'])
            ->paginate(env('PER_PAGE'));

        // ProductCollection::collection($products);

        $categories = Component::getCategories();
        $collect = Product::withTrashed()->get();
        $collect = collect($collect);

        $total = $collect->count();
        $unitsInStock = $collect->where('unitsInStock', '>', 0)->count();
        $unitsoutStock = $collect->where('unitsInStock', '<', 1)->count();

        $trashed = $collect->whereNotNull('deleted_at')->count();

        return response()->json(['categories' => $categories, 'products' => $products, 'total' => $total, 'unitsInStock' => $unitsInStock, 'unitsoutStock' => $unitsoutStock, 'trashed' => $trashed], 200);
    }


    public function uploadImages(Request $request)
    {

        $name = !empty($request->name) ? $request->name : config('app.name');
        if ($request->hasfile('file')) {
            $name = Str::slug($name, '-')  . "-" . time() . '.' . $request->file->extension();

            $request->file->move(public_path("/admin/img/products/"), $name);
        }


        return response()->json($name);
    }

    public function deleteImages(Request $request)
    {
        if (!empty(request('id'))) {
            ProductImages::where([
                'product_id' => $request->id,
                'thumbnail' => $request->name,
            ])->delete();
        }
        $path = "/admin/img/products";
        deleteFile($path, $request->name);
    }

    public function store(Request $request)
    {
        if($request->subcategory_id=="null")
        $subcategory_id=null;
        else
       $subcategory_id=!empty($request->subcategory_id)? $request->subcategory_id : null;

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => !empty($request->category_id) ? $request->category_id : null,
            'subcategory_id' =>   $subcategory_id,
            'quantityPerUnit' => $request->quantityPerUnit,
            'description' =>  $request->description,
            'meta_description' => $request->meta_description,
            'unitPrice' => $request->unitPrice,
            'actualPrice' => $request->actualPrice,
            'unitsInStock' => $request->unitsInStock,
            'discount_price' => $request->discontinued,
            'pageTitle'=>$request->page_title,
            'keywords'=>$request->keywords,
            'isfeatured'=>boolValConverter($request->isfeatured),
        ]);
        $imageList = explode(",", $request->fileList);
        foreach ($imageList as  $key => $value) {
            ProductImages::create([
                'product_id' => $product->id,
                'thumbnail' => $value,
            ]);
        }

        return response()->json($product);
    }

    public function update(Request $request)
    {
        if($request->subcategory_id=="null")
         $subcategory_id=null;
         else
        $subcategory_id=!empty($request->subcategory_id)? $request->subcategory_id : null;

        $product = Product::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'subcategory_id' =>   $subcategory_id,
            'quantityPerUnit' => $request->quantityPerUnit,
            'description' =>  $request->description,
            'meta_description' => $request->meta_description,
            'unitPrice' => $request->unitPrice,
            'actualPrice' => $request->actualPrice,
            'unitsInStock' => $request->unitsInStock,
            'discount_price' => $request->discontinued,
            'keywords'=>$request->keywords,
            'pageTitle'=>$request->page_title,
            'isfeatured'=>boolValConverter($request->isfeatured),
        ]);

        $imageList = explode(",", $request->fileList);

        if (!empty($imageList)) {
            foreach ($imageList as  $key => $value) {
                if (!empty($value)) {
                    ProductImages::updateOrCreate([
                        'product_id' => $request->id,
                        'thumbnail' => $value,
                    ]);
                }
            }
        }
    }

    public function destroy($id){
        $deleted = Product::destroy($id);
        if ($deleted)
            return response()->json($deleted);
    }
    public function getSubCategoryByCat(Request $request){
        $subcategories=SubCategory::where('category_id',$request->category_id)->orderBy('name','ASC')->get();
        return response()->json($subcategories);
    }

    public function trashedProducts(){
        $query = request('query');
        $products = Product::onlyTrashed()->orderBy('name', 'ASC')
            ->where('name', 'like', '%' . $query . '%')->with(['productImages', 'category', 'subcategory'])
            ->paginate(env('PER_PAGE'));

        return response()->json($products);
    }

    public function restoreProducts(Request $request)
    {
        $product = Product::withTrashed()->find($request->id)->restore();
        if ($product) {
            return response()->json($product);
        }
    }

    public function permanentlyDeleteProducts(Request $request)
    {
        ProductImages::where('product_id',$request->id)->delete();
        $product = Product::withTrashed()->find($request->id)->forceDelete();
        if ($product) {
            return response()->json($product);
        }
    }
}
