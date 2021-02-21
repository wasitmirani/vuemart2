<?php

namespace App\Http\Controllers\FrontEndModule\Home;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Helpers\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    //

    public function index()
    {
        $latestProducts = Component::getLatestProducts();
        $featuredProducts = Component::getFeaturedProducts();
        $randomProducts = Component::getRandomProducts();
        $sliders=Component::getSlider();
        $getProductsByCategory=Product::inRandomOrder()->where('unitsInStock', '>', 0)->take(40)->with(['productImages', 'category', 'subcategory'])->get();
        return view('site.page.home', compact('latestProducts', 'featuredProducts', 'randomProducts','getProductsByCategory','sliders'));
    }

    public function singleProduct()
    {
        return view('site.page.singleProduct');
    }
    public function products()
    {
        return view('site.page.products');
    }

    public function thankYou(){
        return view('site.page.thankYou');
    }

    public function Aboutus(){
        return view('site.page.aboutus');
    }
    public function contactus(Request $request){
        return view('site.page.contactus');
    }

}
