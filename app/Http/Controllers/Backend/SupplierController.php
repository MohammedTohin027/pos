<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Supplier::all();
        return view('backend.supplier.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        return view('backend.supplier.create');
    }
    //  store
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:suppliers,email',
        ]);
        $data = new Supplier();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('supplier.view')->with('success', 'Data Inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd('ok');
        $data['editData'] = Supplier::findOrFail($id);
        return view('backend.supplier.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:suppliers,email,'.$id,
        ]);
        $data = Supplier::findOrFail($id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('supplier.view')->with('success', 'Data Updated Successfully!');
    }
    //  delete
    public function delete($id){
        // dd('ok');
        $data = Supplier::findOrFail($id);
        $data->delete();
        return redirect()->route('supplier.view')->with('success', 'Data Deleted Successfully!');
    }
}
