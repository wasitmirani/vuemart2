<?php

namespace App\Helpers;

use App\Models\AppSetting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Cache;


class Component
{


    public static function getAppSetting(){

        if (Cache::has('getAppSetting')) {
            $getAppSetting = Cache::get('getAppSetting');
        } else {
            Cache::put('getAppSetting', AppSetting::first(), sessionTimer());
            $getAppSetting = Cache::get('getAppSetting');
        }

        return   $getAppSetting;
    }
    public static function getLatestProducts()
    {

        if (Cache::has('getLatestProducts')) {
            $getLatestProducts = Cache::get('getLatestProducts');
        } else {
            Cache::put('getLatestProducts', Product::latest()->where('unitsInStock', '>', 0)->take(10)->with(['productImages', 'category', 'subcategory'])->get(), sessionTimer());
            $getLatestProducts = Cache::get('getLatestProducts');
        }

        return   $getLatestProducts;
    }

    public static function getRandomProducts()
    {

        if (Cache::has('getRandomProducts')) {
            $getRandomProducts = Cache::get('getRandomProducts');
        } else {
            Cache::put('getRandomProducts', Product::inRandomOrder()->where('unitsInStock', '>', 0)->take(10)->with(['productImages', 'category', 'subcategory'])->get(), shortTimer());
            $getRandomProducts = Cache::get('getRandomProducts');
        }

        return $getRandomProducts;
    }
    public static function getFeaturedProducts()
    {
        if (Cache::has('getFeaturedProducts')) {
            $getFeaturedProducts = Cache::get('getFeaturedProducts');
        } else {
            Cache::put('getFeaturedProducts', Product::latest()->where('isfeatured', 1)->where('unitsInStock', '>', 0)->take(10)->with(['productImages', 'category', 'subcategory'])->get(), sessionTimer());
            $getFeaturedProducts = Cache::get('getFeaturedProducts');
        }

        return   $getFeaturedProducts;
    }
    public static function getSlider()
    {
        if (Cache::has('getSlider')) {
            $getSlider = Cache::get('getSlider');
        } else {
            Cache::put('getSlider', Slider::where('sort','<','4')->orderBy('sort','ASC')->take(3)->get(), sessionTimer());
            $getSlider = Cache::get('getSlider');
        }

        return   $getSlider;
    }
    public static function getCategories()
    {

        if (Cache::has('getCategories')) {
            $getCategories = Cache::get('getCategories');
        } else {
            Cache::put('getCategories', Category::orderBy('name', 'ASC')->where('status', 1)->with('subCategories')->get(), sessionTimer());
            $getCategories = Cache::get('getCategories');
        }

        return   $getCategories;
    }
}
