<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartView extends Component
{

    public  $cart,$discountSum,$subtotal;
    public function render()
    {
        $session_id = session()->getId();
        $cartobj=new Cart();
        $this->cart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $this->subtotal=  $this->cart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });
        $this->discountSum= $this->cart->sum(function($q){
            return $q->discount_price;
        });
        return view('livewire.cart-view');
    }

    public function deleteItem($id){
        Cart::destroy($id);
    }
    // public function updateQty($item){
    //     dd(['item'=>$item,'qty'=>$this->newQty.$item['id']]);
    // }
}
