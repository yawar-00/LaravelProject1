<?php

use App\Http\Controllers\about;
use App\Http\Controllers\contact;
use App\Http\Controllers\service;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\productController;
use App\Http\Controllers\studentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [usercontroller::class, 'getuser'])->name('home');
Route::get('/about', [about::class, 'getabout'])->name('about');
Route::get('/contact', [contact::class, 'getcontact'])->name('contact');
Route::get('/service', [service::class, 'getservice'])->name('service');
Route::get('/service.service1', [service::class, 'getservice1'])->name('service1');
Route::get('/service.service2', [service::class, 'getservice2'])->name('service2');
Route::post('/contact', [studentController::class, 'store'])->name('store');
Route::get('/contact.showdata', [studentController::class, 'show'])->name('show');
Route::get('/contact/{id}/edit', [studentController::class, 'edit'])->name('edit');
Route::put('/contact/{id}/edit', [studentController::class, 'update']);
Route::get('/contact/{id}/delete', [studentController::class, 'delete']);
Route::get('/contact.insertByAjax', [productController::class, 'index'])->name('insertByAjax');
// Route::get('/contact.showByAjax', [productController::class, 'showProduct']);

Route::post('/contact.insertByAjax', [productController::class, 'store'])->name('product.store');
Route::get('/{id}/edit',[productController::class, 'edit'])->name('product.edit');
Route::delete('/deleteProduct/{id}', [productController::class, 'deletel'])->name('product.delete');
Route::post('/{id}/update', [productController::class, 'update'])->name('product.update');
