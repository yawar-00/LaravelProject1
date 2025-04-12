<?php

use App\Http\Controllers\Home
;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[Home::class,'loadLandig'])->name('landing');
Route::get('/student',[Home::class,'loadStudent'])->name('student');
Route::post('/postData',[Home::class,'storeStudent']);