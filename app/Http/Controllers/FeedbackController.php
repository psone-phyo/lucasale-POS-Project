<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback(){
        $feedback = Contact::all();
        return view('admin.feedback', compact('feedback'));
    }
}
