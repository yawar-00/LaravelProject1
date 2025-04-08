<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\usercontroller;
use  App\Http\Controllers\about;
use  App\Http\Controllers\contact;
use  App\Http\Controllers\service;
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
Route::get('/',[usercontroller::class,'getuser'])->name('home');
Route::get('/about',[about::class,'getabout'])->name('about');
Route::get('/contact',[contact::class,'getcontact'])->name('contact');
Route::get('/service',[service::class,'getservice'])->name('service');
Route::get('/service.service1',[service::class,'getservice1'])->name('service1');
Route::get('/service.service2',[service::class,'getservice2'])->name('service2');