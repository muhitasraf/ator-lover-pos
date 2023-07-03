<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CapacityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
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

Route::get('sales',[SalesController::class, 'index'])->name('sales');
Route::get('sales/create',[SalesController::class, 'create'])->name('sales.create');
Route::post('sales/store',[SalesController::class, 'store'])->name('sales.store');
Route::get('sales/{id}',[SalesController::class, 'show']);
Route::get('sales/{id}/edit',[SalesController::class, 'edit']);
Route::put('sales/update/{id}',[SalesController::class, 'update'])->name('sales.update');
Route::delete('sales/delete/{id}',[SalesController::class, 'destroy'])->name('sales.destroy');

Route::get('capacity',[CapacityController::class, 'index'])->name('capacity');
Route::get('capacity/create',[CapacityController::class, 'create'])->name('capacity.create');
Route::post('capacity/store',[CapacityController::class, 'store'])->name('capacity.store');
Route::get('capacity/{id}',[CapacityController::class, 'show']);
Route::get('capacity/{id}/edit',[CapacityController::class, 'edit']);
Route::put('capacity/update/{id}',[CapacityController::class, 'update'])->name('capacity.update');
Route::delete('capacity/delete/{id}',[CapacityController::class, 'destroy'])->name('capacity.destroy');

Route::post('product_by_brand',[PurchaseController::class, 'product_by_brand']);
Route::post('capacity_by_product',[PurchaseController::class, 'capacity_by_product']);
Route::post('product_details',[SalesController::class, 'product_details']);
