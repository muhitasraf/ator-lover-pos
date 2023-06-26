<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::post('brands/store',[BrandController::class, 'store']);
Route::get('brands/{id}',[BrandController::class, 'show']);
Route::get('brands/{id}/edit',[BrandController::class, 'edit']);
Route::put('brands/update/{id}',[BrandController::class, 'update']);
Route::delete('brands/delete/{id}',[BrandController::class, 'destroy']);

Route::get('product',[ProductController::class, 'index'])->name('brand');
Route::get('product/create',[ProductController::class, 'create'])->name('brand.create');
Route::post('product/store',[ProductController::class, 'store']);
Route::get('product/{id}',[ProductController::class, 'show']);
Route::get('product/{id}/edit',[ProductController::class, 'edit']);
Route::put('product/update/{id}',[ProductController::class, 'update']);
Route::delete('product/delete/{id}',[ProductController::class, 'destroy']);
