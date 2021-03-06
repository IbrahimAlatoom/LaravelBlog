<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/post/{post:slug}',[HomeController::class,'show'])->name('post');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');

// Post Routes
Route::get('/create-post',[HomeController::class,'create'])->name('create')->middleware('auth');
Route::post('/create-post',[HomeController::class,'store'])->name('store')->middleware('auth');
Route::get('/edit-post/{post}',[HomeController::class,'edit'])->name('edit')->middleware('auth');
Route::put('/edit-post/{post}',[HomeController::class,'update'])->name('update')->middleware('auth');
Route::delete('/edit-post/{post}',[HomeController::class,'destroy'])->name('destroy')->middleware('auth');

//Comment Route
Route::post('/create-comment',[HomeController::class,'storeComment'])->name('comments.store')->middleware('auth');

// Category Routes
Route::resource('/categories',CategoryController::class);

Route::get('/about',function(){
    return view('blog.about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
