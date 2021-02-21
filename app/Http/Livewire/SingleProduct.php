<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;

class SingleProduct extends Component
{
    public $product,$relatedProducts,$upsellProducts,$qty=1;
    public function render()
    {

        $id=!empty(request('id')) ? request('id') : $this->product->id;

        $this->product=Product::where('id', $id)->with(['productImages', 'category', 'subcategory'])->first();
        $this->relatedProducts=Product::where('category_id',$this->product->category_id)->where('unitsInStock', '>', 0)->take(20)->get();
        $this->upsellProducts=Product::inRandomOrder()->where('unitsInStock', '>', 0)->take(20)->get();
        SEOTools::setTitle(!empty($this->product->pageTitle) ? $this->product->pageTitle :$this->product->name);
        SEOTools::setDescription($this->product->keywords." ".$this->product->description." ".$this->product->meta_description);
        SEOTools::setCanonical(url()->current());

        return view('livewire.single-product');
    }

    public function addCart($item){


        $qty=!empty($this->qty) ? $this->qty :1;
        $session_id = session()->getId();
        $cartobj=new Cart();
        $this->product=(object)$item;
        $newproduct =(object)$item;
        $checkCart= $cartobj->where(['product_id'=>$newproduct->id,'session_id'=>$session_id])->first();
        if(!empty($checkCart->product_id)){
            $updatedQty=$checkCart->qty+ $qty;
            $cartobj->where(['product_id'=>$newproduct->id,'session_id'=>$session_id])->update(['qty' =>$updatedQty]);
        }
        else {
            $cartobj->create([
                'product_id'=>$newproduct->id,
                'session_id'=>$session_id,
                'name'=>$newproduct->name,
                'unitPrice' => $newproduct->unitPrice,
                'actualPrice' => $newproduct->actualPrice,
                'discount_price'=>$newproduct->discount_price,
                'units'=>$newproduct->quantityPerUnit,
                'qty' => $qty,
            ]);
        }

        $this->emit('cartupdate');
    }
}
