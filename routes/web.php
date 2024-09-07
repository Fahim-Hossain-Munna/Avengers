<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// dashboard home
Route::get('/home',[HomeController::class,'index'])->name('dashboard');

// profile
Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
Route::post('/profile/username/update',[ProfileController::class,'name_update'])->name('profile.name.update');
Route::post('/profile/password/update',[ProfileController::class,'password_update'])->name('profile.password.update');
