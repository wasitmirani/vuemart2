<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function todayOrders(){

        $todayOrders=Order::latest()->where('created_at', '>=', Carbon::today())->paginate(30);
        return response()->json($todayOrders);
    }

    public function customReport(Request $request){
        $startdate=$request->startdate;
        $enddate=$request->enddate;
          $orderSales= Order::select(
            DB::raw('ROUND(SUM(total_unitprice),2) as totalsale'),
            DB::raw("ROUND(SUM(total_actualprice),2) as totalactual"), DB::raw("ROUND(SUM(total_unitprice-total_actualprice),2) as total_profit"),
            DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date"))
            ->where('created_at', '>=',$request->startdate)
            ->where('created_at', '<=', $request->enddate)
            ->where('status',2)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
            $totalSale=$orderSales->sum(function($q){

                return $q->totalsale;
             });
             $totalRevenue=$orderSales->sum(function($q){
                 return round($q->totalsale-$q->totalactual,2);
             });
             $totaldiscount=$orderSales->sum(function($q){
                 return $q->total_discount;
             });
            return response()->json(['orderSales'=>$orderSales,'totalSale'=>$totalSale,'totalRevenue'=>$totalRevenue,'totaldiscount'=>$totaldiscount]);
    }
    public function index(){

        $todayOrders=Order::where('created_at', '>=', Carbon::today())->where('status',2)->get();
        $todaySales=$todayOrders->sum(function($q){
            return $q->total_unitprice;
        });
        $todayRevenue=$todayOrders->sum(function($q){
            return $q->total_unitprice-$q->total_actualprice;
        });

        $weeklySale=$this->weeklyOrdersSale()->sum(function($q){

           return $q->totalsale;
        });
        $weeklyRevenue=$this->weeklyOrdersSale()->sum(function($q){
            return round($q->totalsale-$q->totalactual,2);
        });
        $weeklydiscount=$this->weeklyOrdersSale()->sum(function($q){
            return $q->total_discount;
        });
        $todayusers=User::where('created_at', '>=', Carbon::today())->get()->count();
        $todayproducts=Product::where('created_at', '>=', Carbon::today())->get()->count();
        $json=[
            'customer'=>$this->topCustomer(),
            'weeklySale'=>$this->weeklyOrdersSale(),
            'totalSale'=>$weeklySale,
            'weeklyRevenue'=>$weeklyRevenue,
            'todaySales'=>$todaySales,
            'todayRevenue'=>$todayRevenue,
            'todayUsers'=>$todayusers,
            'todayproducts'=>$todayproducts,
            'todayOrders'=> $todayOrders,
            'weeklydiscount'=>$weeklydiscount,
        ];
        return response()->json($json);


    }

    public function weeklyOrdersSale(){
        $date = \Carbon\Carbon::today()->subDays(7);
        $orders = Order::select(
            DB::raw('ROUND(SUM(total_unitprice),2) as totalsale'),
            DB::raw("ROUND(SUM(total_actualprice),2) as totalactual"), DB::raw("ROUND(SUM(total_unitprice-total_actualprice),2) as total_profit"),
            DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date")
              )
        ->where('created_at','>=',$date)
        ->where('status',2)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        return  $orders;
    }
    public function topCustomer(){
        try {
            //code...
            $topcustomer=DB::table('orders')
            ->select('user_phone',DB::raw('count(user_phone) as totalOrders'),DB::raw('sum(total_unitprice) as totalpurchase'))
            ->where('status',2)
            ->groupBy('user_phone')
            ->take(1)
            ->get();
            if(!empty($topcustomer));
            $order=(object)$topcustomer[0];
            $topcustomerDetails=Order::where('user_phone',$topcustomer[0]->user_phone)->first();
            $customer=[$order,$topcustomerDetails];
            return $customer;
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
