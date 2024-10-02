<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function orderlist()
    {
        $data = Order::select('orders.created_at', 'orders.order_code', 'orders.status', 'users.name', 'users.nickname')
            ->leftjoin('users', 'user_id', 'users.id')
            ->where('orders.status', '!=', 1)
            ->where('orders.status', '!=', 2)
            ->whereany(['orders.created_at', 'orders.order_code', 'users.name', 'users.nickname'], 'like', '%'.request('searchKey'). '%')
            ->groupby('orders.order_code')
            ->orderby('orders.created_at')
            ->get();
        Session::put('pendingData', count($data));
        return view('admin.order.orderlist', compact('data'));
    }

    public function details($ordercode)
    {
        $orderdetails = Order::select('users.id','users.name as user_name', 'users.nickname', 'users.phone', 'users.email', 'products.name as product_name', 'products.photo', 'products.stock', 'products.price', 'orders.count', 'orders.order_code', 'orders.created_at', 'orders.status')
            ->leftjoin('users', 'users.id', 'user_id')
            ->leftjoin('products', 'products.id', 'product_id')
            ->when(Auth::user()->role == 'user', function($query){    //product category search
                $query->where('users.id', Auth::user()->id);
            })
            ->where('orders.order_code', $ordercode)
            ->get();
        $slipdata = PaymentHistory::where('order_code', $ordercode)->first();
        $outofstock = false;
        foreach($orderdetails as $item){
            if ($item->count > $item->stock){
                $outofstock = true;
                break;
            }
        }
        if (Auth::user()->role == 'user'){
        return view('user.orderdetails', compact('orderdetails', 'slipdata'));
        }
        return view('admin.order.orderdetails', compact('orderdetails', 'slipdata', 'outofstock'));
    }

    public function statuschange(Request $request)
    {
        Order::where('order_code', $request['order_code'])->update([
            'status' => $request['status']
        ]);

        if ($request['status'] == 1) {
            $data = Order::select('order_code', 'status')
                ->where('status', '!=', 1)
                ->groupby('order_code')
                ->orderby('created_at')
                ->get();
            Session::put('pendingData', count($data));

            $dataToDelete = Order::select('product_id', 'count')->where('order_code', $request['order_code'])->get();
            foreach ($dataToDelete as $item) {
                Product::where('id', $item->product_id)
                    ->decrement('stock', $item->count);
            }
        }
            $data = Order::select('order_code', 'status')
                ->where('status', '!=', 1)
                ->groupby('order_code')
                ->orderby('created_at')
                ->get();
            Session::put('pendingData', count($data));

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function approvedlist(){
        $data = Order::select('orders.created_at', 'orders.order_code', 'orders.status', 'users.name', 'users.nickname', 'payment_histories.total_amt as total')
        ->leftjoin('users', 'user_id', 'users.id')
        ->leftjoin('payment_histories', 'orders.order_code', 'payment_histories.order_code')
        ->whereIn('orders.status', [1, 2])
        ->whereany(['orders.created_at', 'orders.order_code', 'users.name', 'users.nickname', 'payment_histories.total_amt'], 'like', '%'.request('searchKey'). '%')
        ->groupby('orders.order_code')
        ->orderby('orders.created_at', 'desc')
        ->paginate(5);

        $total = PaymentHistory::sum('total_amt');
        return view('admin.order.approvedlist', compact('data','total'));
    }
}
