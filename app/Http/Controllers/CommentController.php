<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'message' => $request->comment,
        ]);

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'action' => 'commented',
        ]);

        return back();
    }

    //user comment delete
    public function delete($id){
        Comment::find($id)->delete();
        return back();
    }

    public function edit(Request $request){
        if ($request->comment != ''){
            Comment::find($request->id)->update([
                'message' => $request->comment,
            ]);
        }

        return response()->json([
            'status' => 'success'
        ],201);
    }
}
