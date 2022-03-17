<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //  view
    public function view(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('backend.profile.view', compact('user'));
    }

    //  edit
    public function edit(){
        $id = Auth::user()->id;
        $editData = User::findOrFail($id);
        return view('backend.profile.edit', compact('editData'));
    }

    //  update
    public function update(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'email' => 'required|unique:users,email,'.$id,
        ]);
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/profile_images/'.$data->image));
            $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/profile_images'),$file_name);
            $data['image'] = $file_name;
        }
        $data->save();
        return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
    }

    //  change password
    public function changePassword(){
        return view('backend.profile.change-password');
    }

    //  update password
    public function updatePassword(Request $request){
        $check = Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password]);
        if ($check) {
            $user = User::findOrFail(Auth::id());
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('profile.view')->with('success', 'Your password successfully updated!');
        }
        else{
            return redirect()->back()->with('error', 'Current password does not match!');
        }
    }
}