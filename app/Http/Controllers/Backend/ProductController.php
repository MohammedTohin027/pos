<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Product::all();
        return view('backend.product.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.product.create', $data);
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:products,name',
        ]);
        $data = new Product();
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->quantity = '0';
        $data->name = $request->name;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('product.view')->with('success', 'Data Inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd('ok');
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        $data['editData'] = Product::findOrFail($id);
        return view('backend.product.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:products,name,'.$id,
        ]);
        $data = Product::findOrFail($id);
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->updated_by = Auth::user()->id;
        $data->save();
        return redirect()->route('product.view')->with('success', 'Data Updated Successfully!');
    }
    //  delete
    public function delete($id){
        // dd('ok');
        $data = Product::findOrFail($id);
        $data->delete();
        return redirect()->route('product.view')->with('success', 'Data Deleted Successfully!');
    }
}
