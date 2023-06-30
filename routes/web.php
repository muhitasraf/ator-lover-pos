<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'porcessRegistration']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'porcessLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('brands',[BrandController::class, 'index'])->name('brand');
Route::get('brands/create',[BrandController::class, 'create'])->name('brand.create');
Route::get('brands/{id}',[BrandController::class, 'show']);
Route::get('brands/{id}/edit',[BrandController::class, 'edit']);
Route::put('brands/update/{id}',[BrandController::class, 'update']);
Route::delete('brands/delete/{id}',[BrandController::class, 'destroy']);

Route::get('product',[ProductController::class, 'index'])->name('product');
Route::get('product/create',[ProductController::class, 'create'])->name('product.create');
Route::post('product/store',[ProductController::class, 'store']);
Route::get('product/{id}',[ProductController::class, 'show']);
Route::get('product/{id}/edit',[ProductController::class, 'edit']);
Route::put('product/update/{id}',[ProductController::class, 'update']);
Route::delete('product/delete/{id}',[ProductController::class, 'destroy']);

Route::get('type',[TypeController::class, 'index'])->name('type');
Route::get('type/create',[TypeController::class, 'create'])->name('type.create');
Route::post('type/store',[TypeController::class, 'store'])->name('type.store');
Route::get('type/{id}',[TypeController::class, 'show']);
Route::get('type/{id}/edit',[TypeController::class, 'edit']);
Route::put('type/update/{id}',[TypeController::class, 'update'])->name('type.update');
Route::delete('type/delete/{id}',[TypeController::class, 'destroy'])->name('type.destroy');

Route::get('purchase',[PurchaseController::class, 'index'])->name('purchase');
Route::get('purchase/create',[PurchaseController::class, 'create'])->name('purchase.create');
Route::post('purchase/store',[PurchaseController::class, 'store'])->name('purchase.store');
Route::get('purchase/{id}',[PurchaseController::class, 'show']);
Route::get('purchase/{id}/edit',[PurchaseController::class, 'edit']);
Route::put('purchase/update/{id}',[PurchaseController::class, 'update'])->name('purchase.update');
Route::delete('purchase/delete/{id}',[PurchaseController::class, 'destroy'])->name('purchase.destroy');

Route::post('product_by_brand',[PurchaseController::class, 'product_by_brand']);
Route::post('product_details',[PurchaseController::class, 'product_details']);
