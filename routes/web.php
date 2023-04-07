<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;

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

Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'index']);
Route::get('/page-not-found', function(){
    return view('notfound');
});

Route::get('/{pages}', [PagesController::class,'index']);
Route::get('/{category}/{post}', [PostController::class,'index']);
