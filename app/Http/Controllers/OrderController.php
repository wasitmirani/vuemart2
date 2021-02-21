<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function checkout()
    {
        $session_id = session()->getId();
        $cartobj = new Cart();
        $cart = $cartobj->where('session_id', $session_id)->get();
        if ($cart->count() < 1) {
            return back()->with('cartEmpty', 'Your cart is empty');
        }

        return view('site.page.checkout');
    }

    public function orderprint(Request $request){
        $order= Order::where('id',$request->id)->with('orderIteams')->first();
        return view('site.page.print',compact('order'));
    }
    public function index(Request $request)
    {
        $query = request('query');
        switch ($request->dateby) {
            case '1':
                $today = date('Y-m-d');
                $orders = Order::latest()->where('name', 'like', '%' . $query . '%')
                     ->Orwhere('user_phone', 'like', '%' . $query . '%')
                     ->Orwhere('user_email', 'like', '%' . $query . '%')
                     ->Orwhere('address', 'like', '%' . $query . '%')
                    ->where('created_at', '>=', $today)
                    ->where('created_at', '<=', $today)->paginate(env('PER_PAGE'));
                    $collect=Order::latest()->where('name', 'like', '%' . $query . '%')
                    ->where('created_at', '>=', $today)
                    ->where('created_at', '<=', $today)->get();

                break;
            case '2':
                $yesterday = date('Y-m-d', strtotime('-1 days'));
                $orders = Order::latest()->where('name', 'like', '%' . $query . '%')
                ->Orwhere('user_phone', 'like', '%' . $query . '%')
                ->Orwhere('user_email', 'like', '%' . $query . '%')
                ->Orwhere('address', 'like', '%' . $query . '%')
                    ->where('created_at', 'LIKE', "%" . $yesterday . "%")->paginate(env('PER_PAGE'));
                    $collect=Order::latest()->where('name', 'like', '%' . $query . '%')
                    ->where('created_at', 'LIKE', "%" . $yesterday . "%")->get();
                break;
            case '3':
                $today = date('Y-m-d');
                $lastmonth = date('Y-m-d', strtotime('-29 days'));
                $orders = Order::latest()->where('name', 'like', '%' . $query . '%')
                ->Orwhere('user_phone', 'like', '%' . $query . '%')
                ->Orwhere('user_email', 'like', '%' . $query . '%')
                ->Orwhere('address', 'like', '%' . $query . '%')
                ->where('created_at', '>=', $lastmonth)
                ->where('created_at', '<=', $today)->paginate(env('PER_PAGE'));
                $collect=Order::latest()->where('name', 'like', '%' . $query . '%')
                ->where('created_at', '>=', $lastmonth)
                ->where('created_at', '<=', $today)->get();
                break;
            case '4':
                $orders = Order::latest()->where('name', 'like', '%' . $query . '%')
                ->Orwhere('user_phone', 'like', '%' . $query . '%')
                ->Orwhere('user_email', 'like', '%' . $query . '%')
                ->Orwhere('address', 'like', '%' . $query . '%')
                ->paginate(env('PER_PAGE'));
                break;

            default:
                $orders = Order::latest()->where('name', 'like', '%' . $query . '%')
                ->Orwhere('user_phone', 'like', '%' . $query . '%')
                ->Orwhere('user_email', 'like', '%' . $query . '%')
                ->Orwhere('address', 'like', '%' . $query . '%')
                ->paginate(env('PER_PAGE'));
                break;
        }

        $collect=$orders;
        $collect = collect( $collect->all());

        $total = $collect->count();

        $cancel = $collect->where('status', 0)->count();
        $pending = $collect->where('status', 1)->count();
        $Accepted = $collect->where('status', 2)->count();

        return response()->json(['orders' => $orders, 'total' => $total, 'Accepted' => $Accepted, 'pending' => $pending, 'cancel' => $cancel,]);
    }

    public function Orderstatus(Request $request){
        if($request->value=="2")
        Order::where('id',$request->id)->update(['status'=>2]);
        if($request->value=="0")
        Order::where('id',$request->id)->update(['status'=>0]);

    return response()->json([],200);
    }

    public function destroy($id)
    {

        $order=Order::destroy($id);
        if($order){
            return response()->json();
        }
    }
}
