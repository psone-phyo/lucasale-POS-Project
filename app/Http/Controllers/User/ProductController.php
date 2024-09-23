<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('user.shop-detail', compact('details', 'relatedlist'));
    }

    public function addToCart(Request $request, $id){
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'quantity' => $request->qty,
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
