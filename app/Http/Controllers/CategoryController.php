<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            "title" => 'required',
            'image' => 'required|image',
        ]);

        $manager = new ImageManager(new Driver());

        if($request->hasFile('image')){
            $newname = auth()->user()->id . '-' . now()->format("M d ,Y") .'-'. rand(0,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'.$newname));

            if($request->slug){
                Category::insert([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $newname,
                    'created_at' => now(),
                ]);
            }else{
                Category::insert([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $newname,
                    'created_at' => now(),
                ]);
            }

            return back()->with('success_insert','Category Insert Successfull');

        }

    }
}
