<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact(){
        return view('user.contact');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        Contact::create([
            'user_id' => Auth::user()->id,
            'user_name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => 0,
            'action' => 'sent feedback',
        ]);

        return to_route('user#contact')->with('success', 'The feedback has been successfully sent.');
    }
}
