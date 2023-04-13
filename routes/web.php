<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\frontend\PagesController;
use App\Http\Controllers\frontend\ProductsController;

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

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/search', [PagesController::class, 'search'])->name('search');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/products', [ProductsController::class, 'products'])->name('products');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/category', [CategoriesController::class, 'index'])->name('category.index');
Route::get('/category/{id}', [CategoriesController::class, 'show'])->name('category.show');
Route::get('/token/{token}', [VerificationController::class, 'verify'])->name('user.verification');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');


Route::group(['prefix' => 'admin', 'name' => 'admin.'], function () {
    Route::get('/', [AdminPagesController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'products', 'name' => 'admin.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products');
        Route::get('create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    });
    Route::group(['prefix' => 'categories', 'name' => 'admin.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    });
    Route::group(['prefix' => 'brands', 'name' => 'admin.'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brands');
        Route::get('create', [BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::get('destroy/{id}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');

    });
    Route::group(['prefix' => 'divisions', 'name' => 'admin.'], function () {
        Route::get('/', [DivisionController::class, 'index'])->name('admin.divisions');
        Route::get('create', [DivisionController::class, 'create'])->name('admin.divisions.create');
        Route::post('store', [DivisionController::class, 'store'])->name('admin.divisions.store');
        Route::get('edit/{id}', [DivisionController::class, 'edit'])->name('admin.divisions.edit');
        Route::post('update/{id}', [DivisionController::class, 'update'])->name('admin.divisions.update');
        Route::get('destroy/{id}', [DivisionController::class, 'destroy'])->name('admin.divisions.destroy');

    });
    Route::group(['prefix' => 'districts', 'name' => 'admin.'], function () {
        Route::get('/', [DistrictController::class, 'index'])->name('admin.districts');
        Route::get('create', [DistrictController::class, 'create'])->name('admin.districts.create');
        Route::post('store', [DistrictController::class, 'store'])->name('admin.districts.store');
        Route::get('edit/{id}', [DistrictController::class, 'edit'])->name('admin.districts.edit');
        Route::post('update/{id}', [DistrictController::class, 'update'])->name('admin.districts.update');
        Route::get('destroy/{id}', [DistrictController::class, 'destroy'])->name('admin.districts.destroy');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
