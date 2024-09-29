<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(){
        $data = Payment::paginate(5);
        return view('admin.payment.payment', compact('data'));
    }

    public function store(Request $request){
        $this->validation($request);
        Payment::create([
            'account_number' => $request->number,
            'account_type' => $request->type,
            'account_name' => $request->name,
        ]);
        return back()->with('success', 'Payment method is successfully added.');
    }

    public function edit($id){
        $data = Payment::find($id);
        return view('admin.payment.updatepayment', compact('data'));
    }

    public function update(Request $request, $id){
        $this->validation($request);
        Payment::find($id)->update([
            'account_number' => $request->number,
            'account_type' => $request->type,
            'account_name' => $request->name,
        ]);
        return to_route('payment')->with('success', 'Payment method successfully updated.');
    }

    public function destroy($id){
        Payment::find($id)->delete();
        return back()->with('success', 'Payment method is Successfully deleted.');
    }

    private function validation($request){
        $request->validate([
            'name' => 'required|min:2',
            'type' => 'required|min:2',
            'number' => 'required|numeric|min:10'
        ]);
    }
}
