<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CatBlogController;
use App\Http\Controllers\Frontend\GuestAuthentication;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);


// frontend

Route::get('/',[FrontendHomeController::class,'index'])->name('frontend');
Route::get('/category/{slug}',[CatBlogController::class,'show'])->name('frontend.cat.blog');
Route::get('/blogs',[FrontendBlogController::class,'index'])->name('frontend.blogs');
Route::get('/blog/single/{slug}',[FrontendBlogController::class,'single'])->name('frontend.blog.single');
Route::post('/blog/comment/{id}',[FrontendBlogController::class,'comment'])->name('frontend.blog.comment');

Route::get('guest/login',[GuestAuthentication::class,'login'])->name('guest.login');
Route::post('guest/login',[GuestAuthentication::class,'login_post'])->name('guest.login');
Route::get('guest/register',[GuestAuthentication::class,'register'])->name('guest.register');
Route::post('guest/register',[GuestAuthentication::class,'register_post'])->name('guest.register');


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



Route::middleware('excess')->group(function(){
// category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::post('/category/delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::post('/category/status/{id}',[CategoryController::class,'status'])->name('category.status');


// blog

Route::resource('/blog',BlogController::class);
Route::post('/blog/feature/{id}',[BlogController::class,'feature'])->name('blog.feature');


});

