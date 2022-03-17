<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Category::all();
        return view('backend.category.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        return view('backend.category.create');
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $data = new Category();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('category.view')->with('success', 'Data Inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd('ok');
        $data['editData'] = Category::findOrFail($id);
        return view('backend.category.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        $data = Category::findOrFail($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('category.view')->with('success', 'Data Updated Successfully!');
    }
    //  delete
    public function delete($id){
        // dd('ok');
        $data = Category::findOrFail($id);
        $data->delete();
        return redirect()->route('category.view')->with('success', 'Data Deleted Successfully!');
    }
}