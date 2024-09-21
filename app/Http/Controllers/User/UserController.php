<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function home($category_id = 0){
        $data = Product::select('products.id', 'products.name as product_name', 'products.stock','products.price', 'products.photo', 'products.description', 'products.category_id', 'categories.name as category_name')
        ->leftjoin('categories', 'products.category_id', 'categories.id')
        ->when($category_id != 0, function($query) use ($category_id){    //product category search
            $query->where('products.category_id', $category_id);
        })
        ->when(request('min'), function($query) use ($category_id){  //product minium price search
            $query->where('products.price', '>=', request('min'));
        })
        ->when(request('max'), function($query) use ($category_id){ //product maximum price search
            $query->where('products.price', '<=', request('max'));
        })

        //general search for product list
        ->whereAny(['products.name', 'categories.name', 'products.description', 'products.price', 'categories.name'], 'like', '%' . request('searchKey') . '%')
        ->when(request('filter'), function ($query){
            $filter = explode(',', request('filter'));
            $query->orderby($filter[0], $filter[1]);
        })
        ->get();

        //getting category name and id with leftjoin product
        $category = Product::select('categories.name as category_name', 'products.category_id')
        ->leftjoin('categories', 'products.category_id', 'categories.id')
        ->groupby('category_name', 'products.category_id')
        ->get();

        return view('user.index', compact('data', 'category', 'category_id'));
    }

    public function notfound(){
        return view('user.404');
    }
}
