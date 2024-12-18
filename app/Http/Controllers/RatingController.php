<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rating(Request $request){
        Rating::updateOrCreate([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ],[
            'rating' => $request->productRating,
        ]);
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' =>$request->product_id,
            'action' => 'rated',
        ]);

        return back();
    }
}
