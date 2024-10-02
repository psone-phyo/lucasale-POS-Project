<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ProductController extends Controller
{
    public function details($id){
        $details = Product::select('products.id', 'products.name as product_name', 'products.stock','products.price', 'products.photo', 'products.description', 'products.category_id', 'categories.name as category_name')
                    ->leftjoin('categories', 'products.category_id', 'categories.id')
                    ->where('products.id', $id)
                    ->first();

        $relatedlist = Product::select('products.id', 'products.name as product_name', 'products.stock','products.price', 'products.photo', 'products.description', 'products.category_id', 'categories.name as category_name')
                    ->leftjoin('categories', 'products.category_id', 'categories.id')
                    ->where('products.id', '!=' ,$id)
                    ->where('categories.name', $details->category_name)
                    ->get();

        $comment = Comment::select('users.profile','users.name', 'users.nickname', 'comments.id' ,'comments.message', 'comments.created_at', 'comments.user_id', 'comments.product_id')
                    ->leftJoin('users', 'users.id', 'comments.user_id')
                    ->leftJoin('products', 'products.id', 'comments.product_id')
                    ->where('comments.product_id', $id)
                    ->get();

        $ratingAvg = Rating::where('product_id', $id)->avg('rating');

        $rating = Rating::select('rating')->where('user_id', Auth::user()->id)->where('product_id', $id)->first();

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'action' => 'seen',
        ]);
        $log = ActionLog::where('product_id', $id)->count();
        return view('user.shop-detail', compact('details', 'relatedlist', 'comment', 'ratingAvg', 'rating', 'log'));
    }

    public function addToCart(Request $request, $id){
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'quantity' => $request->qty,
        ]);
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'action' => 'add to cart',
        ]);
        return to_route('home');
    }

    public function cart(){
        $cartitems = Cart::select('products.name', 'products.price', 'products.photo', 'carts.user_id', 'carts.product_id', 'carts.quantity', 'carts.id')
                    ->leftjoin('products', 'products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();

        $total = 0;
        foreach($cartitems as $item)
            $total += $item->quantity * $item->price;

        return view('user.cart', compact('cartitems', 'total'));
    }

    public function delete(Request $request){
        Cart::find($request->cardId)->delete();
        return response()->json(200);

    }

    public function apitest(){
        $cartitems = Cart::select('carts.id', 'products.name', 'products.price', 'products.photo', 'carts.user_id', 'carts.product_id', 'carts.quantity')
                    ->leftjoin('products', 'products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();

        return response()->json($cartitems,200);
    }

    public function confirmcart(Request $request){
        $orderArr = [];
        foreach($request->all() as $item){
            array_push($orderArr, [
                'user_id' => $item['userId'],
                'product_id' => $item['productId'],
                'order_code' => $item['orderCode'],
                'count' => $item['qty'],
                'total_amt' => $item['total_amt'],
                'status' => 0,
            ]);
        }
        Session::put( 'tempCart', $orderArr);
        return response()->json([
            'status' => 'success'
        ],200);


    }

}
