<?php

namespace App\Http\Controllers\FrontEndModule\Cart;

use App\Models\Cart;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //

    public function addToCart(Request $request){
        $qty=!empty(request('qty')) ? request('qty') :1;
        $session_id = session()->getId();
        $cartobj=new Cart();
        $product = Product::where('id',$request->product_id)->first();
        $checkCart= $cartobj->where(['product_id'=>$product->id,'session_id'=>$session_id])->first();
        if(!empty($checkCart->product_id)){
            $updatedQty=$checkCart->qty+ $qty;
            $cartobj->where(['product_id'=>$product->id,'session_id'=>$session_id])->update(['qty' =>$updatedQty]);
        }
        else {
            $cartobj->create([
                'product_id'=>$product->id,
                'session_id'=>$session_id,
                'name'=>$product->name,
                'unitPrice' => $product->unitPrice,
                'actualPrice' => $product->actualPrice,
                'discount_price'=>$product->discount_price,
                'units'=>$product->quantityPerUnit,
                'qty' => $qty,
            ]);
        }


        $totalCart=$cartobj->where('session_id',$session_id)->get()->count();


        return response()->json(['name'=>$product->name,'totalcart'=>$totalCart],200);


    }

    public function myCart(){
        $session_id = session()->getId();
        $cartobj=new Cart();
        $cart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $subtotal=$cart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });
        $discountSum=$cart->sum(function($q){
            return $q->discount_price;
        });

        return view('site.components.mycart',compact(['cart','subtotal','discountSum']));
    }

    public function mycartView(){

        return view('site.page.cartview');
    }
    public function removeCart(Request $request){
        $session_id = session()->getId();
        $cartobj=new Cart();
        $cartobj->where(['id'=>$request->id,'session_id'=>$session_id])->delete();
        $cart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $subtotal=$cart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });
        $discountSum=$cart->sum(function($q){
            return $q->discount_price;
        });
        $totalcart=$cart->count();

        return view('site.components.mycart',compact(['cart','subtotal','totalcart','discountSum']));
    }
}
