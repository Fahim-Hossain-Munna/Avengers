<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

// dashboard home
Route::get('/home',[HomeController::class,'index'])->name('dashboard');

// profile
Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
Route::post('/profile/username/update',[ProfileController::class,'name_update'])->name('profile.name.update');
Route::post('/profile/password/update',[ProfileController::class,'password_update'])->name('profile.password.update');
Route::post('/profile/image/update',[ProfileController::class,'image_update'])->name('profile.image.update');

// category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::post('/category/delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');


