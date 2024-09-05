<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        $data = Category::where('name', 'like', '%'.request('searchKey').'%')
                ->orderBy('name')
                ->get();
        return view('admin.category', compact('data'));
    }

    public function store(Request $request){
        $this->validation($request);
        Category::create([
            'name' => $request->category
        ]);
        return to_route('category');
    }

    public function destroy($id){
        Category::find($id)->delete();
        return to_route('category');
    }

    public function editForm($id){
        $data = Category::orderBy('name')->get();
        return view('admin.update-category', compact(['data', 'id']));
    }

    public function edit(Request $request, $id){
        $request->validate([
            'updateCategory' => 'required',
        ]);
        Category::find($id)->update([
            'name'=> $request->updateCategory,
        ]);
        return to_route('category');
    }

    private function validation($request){
        $request->validate([
            'category' => 'required',
        ]);
    }
}
