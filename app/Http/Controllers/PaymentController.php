<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(){
        return view('admin.payment.payment');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:2',
            'type' => 'required|min:2',
            'number' => 'required|numeric|min:10'
        ]);
        Payment::create([
            'account_number' => $request->number,
            'account_type' => $request->type,
            'account_name' => $request->name,
        ]);
        return back()->with('success', 'Payment method is successfully added.');
    }
}
