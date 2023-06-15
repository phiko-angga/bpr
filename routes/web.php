<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\PostCategoryAdminController;
use App\Http\Controllers\Admin\PagesAdminController;
use App\Http\Controllers\Admin\HomeBannerAdminController;
use App\Http\Controllers\Admin\UsersAdminController;
use App\Http\Controllers\Admin\KreditProdukAdminController;
use App\Http\Controllers\Admin\PengajuanAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\SiteAdminController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SimulasiKreditController;
use App\Http\Controllers\BeritaController;

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
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('authenticate');
Route::get('/logout', [LogoutController::class,'index'])->name('logout');

Route::get('/home', [HomeController::class,'index']);
Route::get('/page-not-found', function(){
    return view('notfound');
});

Route::get('/berita', [BeritaController::class,'index']);
Route::get('/category/{name}', [PostController::class,'getPostByCategory']);
Route::post('/kirim-pengajuan', [PengajuanController::class,'submitPengajuan']);
Route::post('/simulasi-kredit/kalkulasi', [SimulasiKreditController::class,'kalkulasi']);

Route::group(['prefix' => 'adminpanel','middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class,'index'])->name('admin');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin_dashboard');
    Route::resource('/post', PostAdminController::class)->name('*','admin_post');
    Route::resource('/post-category', PostCategoryAdminController::class)->name('*','admin_post_category');
    Route::resource('/home-banner', HomeBannerAdminController::class)->name('*','admin_banner');
    Route::resource('/pages', PagesAdminController::class)->name('*','admin_pages');
    Route::resource('/users', UsersAdminController::class)->name('*','admin_user');
    Route::resource('/produk-kredit', KreditProdukAdminController::class)->name('*','admin_produk_kredit');
    Route::resource('/pengajuan', PengajuanAdminController::class)->name('*','admin_pengajuan');
    Route::resource('/menu', MenuAdminController::class)->name('*','admin_menu');
    Route::get('/site', [SiteAdminController::class,'index']);
    Route::post('/site/save', [SiteAdminController::class,'save']);

    Route::get('/dd_get_category', [PostCategoryAdminController::class,'dd_get_category'])->name('dd_get_category');

});

Route::get('/{pages}', [PagesController::class,'index']);
Route::get('/{category}/{post}', [PostController::class,'index']);