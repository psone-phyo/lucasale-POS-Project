<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //view the category form
    public function create(){
        $tbdata = Category::where('name', 'like', '%'.request('searchKey').'%')
                ->orderBy('id')
                ->paginate(5);
        $data = Category::where('name', 'like', '%'.request('searchKey').'%')
<<<<<<< HEAD
            ->orderBy('id')
            ->get();
        return view('admin.category', compact('tbdata','data'));
=======
                ->orderBy('updated_at' , 'desc')
                ->get();
        return view('admin.category.category', compact('data'));
>>>>>>> 3aa2a25
    }

    //add to database
    public function store(Request $request){
        $this->validation($request);
        Category::create([
            'name' => $request->category
        ]);
        return to_route('category');
    }

    //delete category
    public function destroy($id){
        Category::find($id)->delete();
        return to_route('category');
    }

    //view edit form
    public function editForm($id){
<<<<<<< HEAD
        $tbdata = Category::where('name', 'like', '%'.request('searchKey').'%')
                ->orderBy('id')
                ->paginate(5);
        $data = Category::where('name', 'like', '%'.request('searchKey').'%')
            ->orderBy('id')
            ->get();
        return view('admin.update-category', compact(['data', 'id' , 'tbdata']));
=======
        $data = Category::where('name', 'like', '%'.request('searchKey').'%')
                ->orderBy('updated_at' , 'desc')
                ->get();
        // $data = Category::orderBy('name')->get();
        return view('admin.category.update-category', compact(['data', 'id']));
>>>>>>> 3aa2a25
    }

    //edit data in database
    public function edit(Request $request, $id){
        $request->validate([
            'updateCategory' => 'required',
        ]);
        Category::find($id)->update([
            'name'=> $request->updateCategory,
        ]);
        return to_route('category');
    }

    //view category table
    public function categoryTable(){
        $data = Category::paginate(5);
        $count = Category::count();

        return view('admin.category.categoryTable', compact('data', 'count'));
    }


    //calidate the data
    private function validation($request){
        $request->validate([
            'category' => 'required',
        ]);
    }
}
