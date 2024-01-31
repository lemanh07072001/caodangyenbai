<?php

use App\Http\Controllers\Admin\Categories\CategoriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Dashbord\DashboardController;

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

Route::prefix('admin')->group(function () {
    // Dashboard routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    // Categories routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/getData',[CategoriesController::class,'getData'])->name('getData');
        Route::get('/create', [CategoriesController::class, 'create'])->name('create');
        Route::post('/store',[CategoriesController::class,'store'])->name('store');
        Route::post('/changeCategories/{id}',[CategoriesController::class,'changeCategories'])->name('changeCategories');
        Route::post('/changeStatus/{id}',[CategoriesController::class,'changeStatus'])->name('changeStatus');
        Route::post('/editTile',[CategoriesController::class,'editTile'])->name('editTile');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
    });
});
