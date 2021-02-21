<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartItems extends Component
{
    public $cart,$total,$subtotal;
    public $num=0;
    protected $listeners = ['cartUpdated' => 'updateCart'];
    public function mount()
    {
        $session_id = session()->getId();
        $cartobj=new Cart();
        $this->cart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $this->subtotal=$this->cart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });

        return view('livewire.cart-items');
    }


    public  function removeCart($id){


              $session_id = session()->getId();
    $cartobj=new Cart();
    $cartobj->where(['id'=>$id,'session_id'=>$session_id])->delete();
    $this->cart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

    $this->subtotal=$this->cart->sum(function($q){
        return $q->qty*$q->unitPrice;
    });
}
    public function updateCart(){
        $session_id = session()->getId();
        $cartobj=new Cart();

        $this->cart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $this->subtotal=$this->cart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });
    }
}
