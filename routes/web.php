<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/','home')->name('home');
    Route::get('/placesearch','place_search')->name('place_search');
    Route::get('/map','place_map')->name('place_map');
    Route::get('/create','create')->name('create');
    Route::get('/posts/{post}','show')->name('show');
    Route::get('/userposts/{post}','usershow')->name('show');
    Route::post('/posts','store')->name('store');
    Route::get('/posts/{post}/edit','edit')->name('edit');
    Route::put('/posts/{post}','update')->name('update');
    Route::delete('/posts/{post}','delete')->name('delete');
});

Route::controller(UserController::class)->middleware(['auth'])->group(function(){
    Route::get('userhome','user_home')->name('user_home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
