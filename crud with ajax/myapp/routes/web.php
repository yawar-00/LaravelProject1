<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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


Route::get('/', [ProductsController::class, ])->name('product.index');

Route::prefix('products')->group(function(){
    Route::post('/save-item', [ProductsController::class, 'store'])->name('product.store');
    Route::post('/{id}/update', [ProductsController::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete');
});

