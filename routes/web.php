<?php

use App\Http\Controllers\Admin\Categories\CategoriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Dashbord\DashboardController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\GroupIndex\GroupIndexController;
use App\Http\Controllers\Admin\GroupPost\GroupPostController;
use App\Http\Controllers\Admin\Post\PostController;
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

    // Post routes
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/getData', [PostController::class, 'getData'])->name('getData');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::post('/changeCategories/{id}', [PostController::class, 'changeCategories'])->name('changeCategories');
        Route::post('/updateTitle/{id}', [PostController::class, 'updateTitle'])->name('updateTitle');
        Route::get('/getTitle/{id}', [PostController::class, 'getTitle'])->name('getTitle');
        Route::post('/changeStatus/{id}', [PostController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/editTile', [PostController::class, 'editTile'])->name('editTile');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
    });

    // groupPost routes
    Route::prefix('groupPost')->name('groupPost.')->group(function () {
        Route::get('/', [GroupPostController::class, 'index'])->name('index');
        Route::get('/getData', [GroupPostController::class, 'getData'])->name('getData');
        Route::get('/create', [GroupPostController::class, 'create'])->name('create');
        Route::post('/store', [GroupPostController::class, 'store'])->name('store');
        Route::post('/changeCategories/{id}', [GroupPostController::class, 'changeCategories'])->name('changeCategories');
        Route::post('/updateTitle/{id}', [GroupPostController::class, 'updateTitle'])->name('updateTitle');
        Route::get('/getTitle/{id}', [GroupPostController::class, 'getTitle'])->name('getTitle');
        Route::post('/changeStatus/{id}', [GroupPostController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/editTile', [GroupPostController::class, 'editTile'])->name('editTile');
        Route::get('/edit/{id}', [GroupPostController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GroupPostController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [GroupPostController::class, 'destroy'])->name('destroy');

        Route::get('/list_post/{id}', [GroupPostController::class, 'listPost'])->name('listPost');
        Route::get('/list_post_data', [GroupPostController::class, 'listPostData'])->name('listPostData');
        Route::post('/add_list_post_data', [GroupPostController::class, 'addListPostData'])->name('addListPostData');

        Route::get('/get_list_post/{id}', [GroupPostController::class, 'getListPost'])->name('getListPost');
        Route::delete('/destroy_list_post/{id}', [GroupPostController::class, 'destroyListPost'])->name('destroyListPost');
    });

    // GroupIndex routes
    Route::prefix('groupIndex')->name('groupIndex.')->group(function () {
        Route::get('/', [GroupIndexController::class, 'index'])->name('index');
        Route::get('/getData', [GroupIndexController::class, 'getData'])->name('getData');
        Route::get('/create', [GroupIndexController::class, 'create'])->name('create');
        Route::post('/store', [GroupIndexController::class, 'store'])->name('store');
        Route::post('/changeCategories/{id}', [GroupIndexController::class, 'changeCategories'])->name('changeCategories');
        Route::post('/updateTitle/{id}', [GroupIndexController::class, 'updateTitle'])->name('updateTitle');
        Route::get('/getTitle/{id}', [GroupIndexController::class, 'getTitle'])->name('getTitle');
        Route::post('/changeStatus/{id}', [GroupIndexController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/editTile', [GroupIndexController::class, 'editTile'])->name('editTile');
        Route::get('/edit/{id}', [GroupIndexController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GroupIndexController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [GroupIndexController::class, 'destroy'])->name('destroy');
    });
});
