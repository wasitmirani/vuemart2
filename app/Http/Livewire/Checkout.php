<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Mail\OrderShipped;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Checkout extends Component
{
    public $mycart,$subtotal,$discountSum;
    public $name,$phone,$email,$state,$address,$houseaddress,$town,$ordernotes;
    public function __construct()
    {
        if(Auth::check()){
            $this->name=Auth::user()->name;
            $this->phone=Auth::user()->phone;
            $this->email=Auth::user()->email;
            $this->address=Auth::user()->address;
        }
    }
    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'nullable|email',
        'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        'address'=>'required|min:10',
        'town'=>'required',
    ];
    public function render()
    {
        $session_id = session()->getId();
        $cartobj=new Cart();
        $this->mycart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $this->subtotal=$this->mycart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });
        $this->discountSum=$this->mycart->sum(function($q){
            return $q->discount_price;
        });

        return view('livewire.checkout');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function proceedOrder(){
      $this->validate();
      $orderToken=Str::random(6);
      $session_id = session()->getId();
        $cartobj=new Cart();
        $mycart=$cartobj->where('session_id',$session_id)->with('product')->latest()->get();

        $subtotal=$mycart->sum(function($q){
            return $q->qty*$q->unitPrice;
        });
        $totaldiscount=$mycart->sum(function($q){
            return $q->discount_price;
        });
        $totalactualprice=$mycart->sum(function($q){
            return $q->actualPrice;
        });
      $neworder=Order::create([
            'name'=>$this->name,
            'order_token'=>$orderToken,
            'user_phone'=>$this->phone,
            'user_id'=>!empty(Auth::user()->id) ? Auth::user()->id : null,
            'user_email'=>$this->email,
            'address'=>$this->address." ".$this->houseaddress." ".$this->town." ".$this->state,
            'order_notes'=>$this->ordernotes,
            'total_actualprice'=>$totalactualprice,
            'total_unitprice'=>$subtotal,
            'total_discount'=>$totaldiscount,
            'status'=>1,
        ]);
        $this->confirmOrder($mycart, $neworder);
        $this->sendMail($neworder);
        return redirect()->route('thankyou');
    }

    public function sendMail($order){
        $email = env('LEAD_EMAIL');
        $message_url = route('order.print', ['id' => $order->id]);
        $maildata = [
            'title' => 'You have received a new Order from ' . $order->name,
            'phone' =>  $order->user_phone,
            'name'=>$order->name,
            'subject' =>  'You have received a new Order from ' . $order->name."|".$order->user_phone,
            'address' => $order->address,
            'sender_name' => Auth::Check() ? Auth::user()->name : 'bot user',
            'total_unitprice'=>$order->total_unitprice,
            'total_discount'=>$order->total_discount,
            'total'=>$order->total_unitprice -$order->total_discount ,
            'url' => $message_url,
            'message_url' => $message_url,
        ];
        Mail::to($email)->send(new OrderShipped($maildata));

    }
    public function confirmOrder($mycart,$order){

        foreach ($mycart as  $item) {
            OrderDetails::create([
                'order_id'=>$order->id,
                'product_id'=>$item->product_id,
                'name'=>$item->name,
                'qty'=>$item->qty,
                'units'=>$item->units,
                'unitPrice'=>$item->unitPrice,
                'actualPrice'=>$item->actualPrice,
                'discount_price'=>$item->discount_price,
            ]);
        }
       $order= OrderDetails::where('order_id',$order->id)->get();

        $session_id = session()->getId();
        $cartobj=new Cart();
        $mycart=$cartobj->where('session_id',$session_id)->delete();
    }

}
