<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
}
