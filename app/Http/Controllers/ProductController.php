<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Console\View\Components\Alert;
use PhpParser\Builder\Function_;

class ProductController extends Controller
{
    public Function create(){
        $data = Category::select('id', 'name')->get();
        return view('admin.product.addproduct', compact('data'));
    }

    public function list($lowamt = 'default'){
        $data = Product::select('products.id', 'products.name as product_name', 'products.stock','products.price', 'products.photo', 'products.description', 'products.category_id', 'categories.name as category_name')
                ->leftjoin('categories', 'products.category_id', 'categories.id')
                ->whereAny(['products.name', 'categories.name'], 'like', '%' . request('searchKey') . '%');


        if ($lowamt == 'lowamount'){
            $data = $data->where('products.stock', '<=', 3);
        }
        $count = $data->count();
        $data = $data->paginate(5);
        return view('admin.product.product', compact('data','count'));
    }

    public function store(Request $request){
        $this->validation($request, 'create');
        $filename = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('product'), $filename);

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

    //show edit product form
    public function editform($id){
        $category = Category::select('id', 'name')->get();
        $data = Product::find($id);
        return view('admin.product.editproduct', compact('data','category'));
    }

    public function edit(Request $request, $id){
        $this->validation($request, 'update');
        $data = [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];
        if ($request->hasFile('image')){
            unlink(public_path('product/'. $request->oldphoto));
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product'), $filename);
            $data['photo'] = $filename;
        }else{
            if ($request->hasFile('oldphoto')){
                $data['photo'] = $request->oldphoto;
            }

        }
        Product::find($id)->update($data);
        return to_route('productlist')->with('success', 'Product successfully updated.');
    }

    //view details product
    public function view($id){
        $data = Product::select('products.id', 'products.name as product_name', 'products.stock','products.price', 'products.photo', 'products.description', 'products.category_id', 'categories.name as category_name')
        ->leftjoin('categories', 'products.category_id', 'categories.id')
        ->where('products.id', $id)
        ->first();
        // dd($data->toArray());
        return view('admin.product.viewproduct', compact('data'));
    }

    //delete product
    public function destroy($id){
        $data = Product::select('photo')
                ->where('id', $id)
                ->first();

        if (file_exists(public_path('product/'. $data->photo))){
            unlink(public_path('product/'. $data->photo));
        }
        Product::find($id)->delete();
        return back()->with('success', 'Product is Successfully deleted.');
    }

    private function validation($request, $action){
        $data = [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        if ($action == 'create'){
            $data['image'] = 'required|mimes:png,jpg,jpeg,svg,webp,avif';
        }else{
            $data['image'] = 'mimes:png,jpg,jpeg,svg,webp,avif';
        }

        $request->validate($data);
    }

}
