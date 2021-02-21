<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\App\AppController;
use App\Http\Controllers\Admin\Seo\SeoController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\SubCategory\SubCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {
Route::resource('category', CategoryController::class)->only('index', 'store', 'destroy');

Route::prefix('category')->name('category.')->group(function () {

    Route::post("/update", [CategoryController::class, 'update'])->name('update');
    Route::get('/trashed ', [CategoryController::class, 'trashedCategory'])->name('trashed');
    Route::get('/restore', [CategoryController::class, 'restoreCategory'])->name('restore');
    Route::get('/permanently/delete', [CategoryController::class, 'permanentlyDeleteCategory'])->name('permanently.delete');
    Route::any('/catgory/upload', [CategoryController::class, 'uploadCategory']);
});


Route::resource('subcategory', SubCategoryController::class)->only('index', 'store', 'destroy');
Route::prefix('subcategory')->name('subcategory.')->group(function () {
    Route::post("/update", [SubCategoryController::class, 'update'])->name('update');
    Route::get('/trashed ', [SubCategoryController::class, 'trashedCategory'])->name('trashed');
    Route::get('/restore', [SubCategoryController::class, 'restoreCategory'])->name('restore');
    Route::get('/permanently/delete', [SubCategoryController::class, 'permanentlyDeleteCategory'])->name('permanently.delete');
});


Route::resource('product', ProductController::class)->only('index', 'store', 'destroy');
Route::prefix('product')->name('product.')->group(function () {
    Route::post("/update", [ProductController::class, 'update'])->name('update');

    Route::get("/delete/image", [ProductController::class, 'deleteImages'])->name('delete.images');

    Route::get('/subcategories/{category_id}',[ProductController::class,'getSubCategoryByCat']);
    Route::get('/trashed ', [ProductController::class, 'trashedProducts'])->name('trashed');
    Route::get('/restore', [ProductController::class, 'restoreProducts'])->name('restore');
    Route::get('/permanently/delete', [ProductController::class, 'permanentlyDeleteProducts'])->name('permanently.delete');
});

Route::resource('order', OrderController::class)->only('index','destroy');

Route::prefix('order')->name('order.')->group(function () {
Route::get('/status',[OrderController::class,'Orderstatus']);
});


Route::resource('seo', SeoController::class)->only('index', 'store', 'destroy');
Route::prefix('seo')->name('seo.')->group(function () {
    Route::post("/update", [SeoController::class, 'update'])->name('update');
});

Route::resource('user', UserController::class)->only('index', 'destroy');
Route::prefix('user')->name('user.')->group(function () {
    Route::post("/update", [UserController::class, 'update'])->name('update');
    Route::post("/store", [UserController::class, 'store'])->name('store');

});

Route::resource('role', RoleController::class)->only('index', 'destroy');
Route::prefix('role')->name('role.')->group(function () {
    Route::post("/update", [RoleController::class, 'update'])->name('update');
    Route::post("/store", [RoleController::class, 'store'])->name('store');

});
Route::resource('permission', PermissionController::class)->only('index', 'destroy');
Route::prefix('permission')->name('permission.')->group(function () {
    Route::post("/update", [PermissionController::class, 'update'])->name('update');
    Route::post("/store", [PermissionController::class, 'store'])->name('store');

});


Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/today-orders',[DashboardController::class,'todayOrders']);
Route::post('/sales/reports',[DashboardController::class,'customReport']);
Route::post('/update/user/account',[AppController::class,'AccountUpdate']);
Route::get('website/info',[AppController::class,'WebsiteInfo']);
Route::post('website/info/update',[AppController::class,'WebsiteInfoUpdate']);
Route::post('/website/social/update',[AppController::class,'WebsitesocialUpdate']);

Route::resource('slider', SliderController::class)->only('index', 'destroy');
Route::prefix('slider')->name('slider.')->group(function () {
    Route::post("/update", [SliderController::class, 'update'])->name('update');
    Route::post("/store", [SliderController::class, 'store'])->name('store');

});

});
Route::post("product/upload/images", [ProductController::class, 'uploadImages'])->name('upload.images');
Route::post('/user/thumbnail/update',[AppController::class,'UserThumbnailUpdate']);
