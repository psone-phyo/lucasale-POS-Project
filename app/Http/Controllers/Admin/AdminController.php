<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard(){
        $total = PaymentHistory::sum('total_amt');
        $user = User::where('role', 'user')->count();
        $product = Product::count();
        $pending = Order::select('order_code')
                ->where('status', 0)
                ->groupby('order_code')
                ->count();
        return view('admin.index', compact('total', 'user', 'product', 'pending'));
    }
}
