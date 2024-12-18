<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function payment(){
        $banktype = Payment::orderby('account_type',)->get();
        $ordercart = Session::get('tempCart');
        return view('user.payment', compact('banktype', 'ordercart'));
    }

    public function order(Request $request){
        $request->validate([
            'phone' => 'required|numeric|min:8',
            'address' => 'required',
            'paymentmethod' => 'required',
            'paymentslip' => 'required|mimes:png,jpg,jpeg',
        ]);
        if ($request->hasFile('paymentslip')){
            $filename = uniqid() . $request->file('paymentslip')->getClientOriginalName();
            $request->file('paymentslip')->move(public_path('paymentslip'), $filename);
        }
        PaymentHistory::create([
                'username' => Auth::user()->name ?? Auth::user()->nickname,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_type' => $request->paymentmethod,
                'payslip_image' => $filename,
                'order_code' => $request->ordercode,
                'total_amt' => $request->totalamount,
        ]);

        $ordercart = Session::get('tempCart');
        foreach ($ordercart as $item){
            Order::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'order_code' => $item['order_code'],
                'count' => $item['count'],
                'status' => $item['status'],
            ]);

            Cart::where('user_id', $item['user_id'])->where('product_id', $item['product_id'])->delete();
        }
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => 0,
            'action' => 'order',
        ]);
        return to_route('user#orderlist');

    }

    public function orderlist(){
        $orderlist = Order::where('user_id', Auth::user()->id)
                    ->groupby('order_code')
                    ->orderby('created_at', 'desc')
                    ->get();
        return view('user.orderlist', compact('orderlist'));
    }
}
