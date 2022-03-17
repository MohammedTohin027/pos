<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Unit::all();
        return view('backend.unit.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        return view('backend.unit.create');
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:units,name',
        ]);
        $data = new Unit();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('unit.view')->with('success', 'Data Inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd('ok');
        $data['editData'] = Unit::findOrFail($id);
        return view('backend.unit.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:units,name,'.$id,
        ]);
        $data = Unit::findOrFail($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('unit.view')->with('success', 'Data Updated Successfully!');
    }
    //  delete
    public function delete($id){
        // dd('ok');
        $data = Unit::findOrFail($id);
        $data->delete();
        return redirect()->route('unit.view')->with('success', 'Data Deleted Successfully!');
    }
}
