<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagementController extends Controller
{
    public function index(){
        $managers = User::where('role','manager')->get();
        return view('dashboard.management.auth.index',compact('managers'));
    }

    public function register_user(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);


        if(!$request->role == ""){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        return back()->with('success_insert','User Register Successfully Update');

        }else{
            return back()->withErrors(['role'=> "please select any role first"])->withInput();
        }

    }


    public function role_undo($id){
        $manager = User::where('id',$id)->first();

        if($manager->role == 'manager'){
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
        return back()->with('success_insert','Role Change Successfully Update');

        }
        return back()->with('success_insert','Role Change Successfully Update');

        }


    }

