<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderlist(){
        $data = Order::select('orders.created_at', 'orders.order_code', 'orders.status', 'users.name', 'users.nickname')
                ->leftjoin('users', 'user_id' ,'users.id')
                ->groupby('orders.order_code')
                ->orderby('orders.created_at')
                ->get();
        return view('admin.order.orderlist', compact('data'));
    }

    public function details($ordercode){
        $orderdetails = Order::select('users.name as user_name', 'users.nickname', 'users.phone', 'users.email', 'products.name as product_name', 'products.photo','products.stock', 'products.price', 'orders.count', 'orders.order_code', 'orders.created_at')
                        ->leftjoin('users', 'users.id', 'user_id')
                        ->leftjoin('products', 'products.id', 'product_id')
                        ->where('orders.order_code', $ordercode)
                        ->get();
        $slipdata = PaymentHistory::where('order_code', $ordercode)->first();
        return view('admin.order.orderdetails', compact('orderdetails', 'slipdata'));
    }

    public function statuschange(Request $request){
        Order::where('order_code', $request['order_code'])->update([
            'status' => $request['status']
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
