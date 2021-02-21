<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\FrontEndModule\Cart\CartController;
use App\Http\Controllers\FrontEndModule\Home\FrontEndController;
use App\Http\Controllers\FrontEndModule\Member\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});



Route::get('/', [FrontEndController::class, 'index'])->name('index');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.cart');
Route::get('/products', [FrontEndController::class, 'products'])->name('products');
Route::get('/product/{slug}/{id}', [FrontEndController::class, 'singleProduct'])->name('product.view');
Route::get('/my-cart',[CartController::class,'myCart'])->name('my-cart');
Route::get('/remove/cart/{id}',[CartController::class,'removeCart'])->name('remove.cart');
Route::get('/mycart/view',[CartController::class,'mycartView'])->name('mycart.view');
Route::get('/checkout',[OrderController::class,'checkout'])->name('checkout');
Route::get('thank-you',[FrontEndController::class,'thankYou'])->name('thankyou');
Route::get('/about-us',[FrontEndController::class,'Aboutus'])->name('aboutus');
Route::get('/services',[FrontEndController::class,'services'])->name('services');
Route::get('contact-us',[FrontEndController::class,'contactus'])->name('contactus');


Route::prefix('member')->name('member.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');

});

Route::get('print/order/{id}',[OrderController::class,'orderprint'])->name('order.print');
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::get('/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook');
    Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

});
