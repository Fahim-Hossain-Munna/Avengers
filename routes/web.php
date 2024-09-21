<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
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


Route::middleware('authRole')->group(function(){
    // management
    Route::get('/user/authenticate',[ManagementController::class,'index'])->name('management.index');
    Route::post('/user/authenticate',[ManagementController::class,'register_user'])->name('management.user.register');
    Route::post('/user/authenticate/role/undo/{id}',[ManagementController::class,'role_undo'])->name('management.user.role.undo');


    Route::get('/user/role/assign',[ManagementController::class,'role_assign'])->name('role.assign');
    Route::post('/user/role/assign',[ManagementController::class,'role_assign_post'])->name('role.assign');
    Route::post('/user/authenticate/role/undo/blogger/{id}',[ManagementController::class,'role_undo_blogger'])->name('management.user.role.undo.blogger');

    Route::post('/user/authenticate/role/undo/user/{id}',[ManagementController::class,'role_undo_user_block'])->name('management.user.role.undo.user');


});




// category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::post('/category/delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::post('/category/status/{id}',[CategoryController::class,'status'])->name('category.status');


// blog

Route::resource('/blog',BlogController::class);



