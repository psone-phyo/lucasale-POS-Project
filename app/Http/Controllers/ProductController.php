<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Console\View\Components\Alert;


class ProductController extends Controller
{
    public Function create(){
        $data = Category::select('id', 'name')->get();
        return view('admin.addproduct', compact('data'));
    }

    public function list($lowamt = 'default'){
        $data = Product::select('products.id', 'products.name as product_name', 'products.stock','products.price', 'products.photo', 'products.description', 'products.category_id', 'categories.name as category_name')
                ->leftjoin('categories', 'products.category_id', 'categories.id')
                ->whereAny(['products.name', 'categories.name'], 'like', '%' . request('searchKey') . '%');


        if ($lowamt == 'lowamount'){
            $data = $data->where('products.stock', '<=', 3);
        }
        $data = $data->paginate(5);
        return view('admin.product', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,svg,webp',
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $filename = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('admin/img/product'), $filename);

        Product::create([
            'photo' => $filename,
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Created successfully');
    }
}
