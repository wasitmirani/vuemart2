<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Helpers\Component as CacheComponent;

class Products extends Component
{
    use WithPagination;
    public $categories,$query,$categoryId,$selectedCategory,$selectedsubCategory,$subcategoryid;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {


        SEOTools::setTitle('Online Grocery Store and Super Market in Sukkur,Sindh - Vuemart.pk');
        SEOTools::setDescription('Vuemart is an Online grocery store and super market in Sukkur, Sindh. You order online and we will deliver grocery anywhere in Sukkur. Same Day delivery and Next Day deliver. No minimum order limit. Free delivery . Payment methods Cash on Delivery available.');
        SEOTools::setCanonical(url()->current());


        if(!empty(request('query'))){

            $this->query=request('query');
        }

        $query=!empty(request('query')) ? request('query') : "";
        $this->categories = Category::select('categories.*', DB::raw('count(products.category_id) as total'))
        ->join('products','products.category_id','=','categories.id')
        ->take(20)
        ->groupBy('products.category_id')
        ->get();
            $this->categoryId=(request('category')=="true") ? request('categoryid') : $this->categoryId;
            $this->subcategoryid=(request('subcategory')=="true") ? request('subcategoryid') : $this->subcategoryid;

        if(!empty($this->categoryId))
        {
            $data=$this->getProductByCategory();
        }
        else {
            if(!empty($this->subcategoryid))
                $data=$this->getProductBySubCategory();
            else
            $data=$this->getProducts();
        }
        return view('livewire.products',[
            'products' =>  $data,
        ]);
    }

    public function allProducts(){
        $this->categoryId="";
    }
    public function getProducts(){

      return  Product::orderBy('name', 'ASC')
        ->where('name', 'like', '%' . $this->query . '%')
        ->orwhere('quantityPerUnit', 'like', '%' .$this->query. '%')
        ->orwhere('unitsInStock', 'like', '%' . $this->query . '%')
        ->orwhere('actualPrice', 'like', '%' . $this->query . '%')
        ->orwhere('unitPrice', 'like', '%' . $this->query . '%')
        ->orwhere('discount_price', 'like', '%' . $this->query . '%')
        ->orwhereHas('category', function ($q)  {
            return $q->where('name', 'like', '%' . $this->query . '%');
        })->orwhereHas('subcategory', function ($q)  {
            return $q->where('name', 'like', '%' . $this->query. '%');
        })->with(['productImages', 'category', 'subcategory'])
        ->paginate(env('PER_PAGE'));
    }
    public function getProductByCategory(){
        return Product::whereHas('category', function ($q)  {
            return $q->where('id',$this->categoryId);
        })
        ->where('name', 'like', '%' . $this->query . '%')
        ->with(['productImages', 'category', 'subcategory'])
        ->paginate(env('PER_PAGE'));
    }
    public function  getProductBySubCategory(){
        if(!empty($this->subcategoryid))
        $this->selectedCategory=SubCategory::where('id',$this->subcategoryid)->first();
        return Product::whereHas('subcategory', function ($q)  {
            return $q->where('id',$this->subcategoryid);
        })
        ->where('name', 'like', '%' . $this->query . '%')
        ->with(['productImages', 'category', 'subcategory'])
        ->paginate(env('PER_PAGE'));
    }

    public function productsByCategory($id){


        $this->categoryId=$id;
        // if(!empty($this->categoryId))
         $this->selectedCategory=Category::where('id',$this->categoryId)->first();


    }

    public function clearCategory(){
        $this->selectedCategory="";
        $this->categoryId="";
        $this->subcategoryid="";
        $this->getProducts();

    }

}
