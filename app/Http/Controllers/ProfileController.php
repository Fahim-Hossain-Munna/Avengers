<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }

    public function name_update(Request $request){
        $oldname = auth()->user()->name;
        $request->validate([
            'name' => 'required',
        ]);

        User::find(auth()->id())->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);

        return back()->with('name_update',"Name Update Successful $oldname to $request->name");
    }


    public function password_update(Request $request){

        $request->validate([
            'c_pass' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if(Hash::check($request->c_pass,auth()->user()->password)){
            User::find(auth()->user()->id)->update([
                'password' => $request->password,
                'updated_at' => now(),
            ]);
            return back()->with('password_update','password update successfull');
        }else{
            return back()->withErrors(['password'=>'current password not match with our record'])->withInput();
        }

    }
}
