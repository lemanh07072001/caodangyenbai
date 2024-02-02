<?php

use App\Http\Controllers\Admin\Categories\CategoriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Dashbord\DashboardController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Slide\SlideController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    // Categories routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/getData', [CategoriesController::class, 'getData'])->name('getData');
        Route::get('/create', [CategoriesController::class, 'create'])->name('create');
        Route::post('/store', [CategoriesController::class, 'store'])->name('store');
        Route::post('/changeCategories/{id}', [CategoriesController::class, 'changeCategories'])->name('changeCategories');
        Route::post('/changeStatus/{id}', [CategoriesController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/editTile', [CategoriesController::class, 'editTile'])->name('editTile');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
    });

    // Banner routes
    Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('/getData', [BannerController::class, 'getData'])->name('getData');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::post('/changeStatus/{id}', [BannerController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/editTile', [BannerController::class, 'editTile'])->name('editTile');
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BannerController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [BannerController::class, 'destroy'])->name('destroy');
    });

    // Slide routes
    Route::prefix('slide')->name('slide.')->group(function () {
        Route::get('/', [SlideController::class, 'index'])->name('index');
        Route::get('/getData', [SlideController::class, 'getData'])->name('getData');
        Route::get('/create', [SlideController::class, 'create'])->name('create');
        Route::post('/store', [SlideController::class, 'store'])->name('store');
        Route::post('/changeStatus/{id}', [SlideController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/editTile', [SlideController::class, 'editTile'])->name('editTile');
        Route::get('/edit/{id}', [SlideController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SlideController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [SlideController::class, 'destroy'])->name('destroy');
    });
});
