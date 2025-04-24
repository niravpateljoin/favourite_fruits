<?php

use App\Http\Controllers\FruitController;
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

Route::get('/dashboard', [FruitController::class, 'index'])->name('dashboard');
Route::post('/fruits/{fruit}/favorite', [FruitController::class, 'favorite']);
Route::get('/favorites', [FruitController::class, 'favorites'])->name('favorites');
