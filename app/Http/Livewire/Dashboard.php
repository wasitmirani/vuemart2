<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $myorders;

    public $name,$phone,$email,$state,$address;
    public function __construct()
    {

            $this->name=Auth::user()->name;
            $this->phone=Auth::user()->phone;
            $this->email=Auth::user()->email;
            $this->address=Auth::user()->address;

    }
    public function render()
    {
        $this->myorders=Order::latest()->where('user_id',Auth::user()->id)
        ->orwhere('user_phone',Auth::user()->phone)
        ->orwhere('user_email',Auth::user()->email)
        ->get();

        return view('livewire.dashboard');
    }


    public function updateUser(){
        $this->validate([
            'phone' => ['required',  'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:255', 'unique:users,phone,'.auth()->user()->id],
        ]);
        $user=User::where('id',auth()->user()->id)
        ->update([
            'name'=>$this->name,
            'phone'=>$this->phone,
            'address'=>$this->address,
        ]);
        return back()->with('update_user','User information has been updated');
    }
}
