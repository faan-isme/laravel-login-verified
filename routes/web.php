<?php

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\SessionController;
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

Route::get('/', [SessionController::class, 'index'])->name('index');
Route::get('/register',[SessionController::class,'register'])->name('register');
Route::get('/home',[HalamanController::class,'home'])->name('home')->middleware('auth');
Route::post('/login', [SessionController::class, 'login'])->name('login');
Route::post('/create', [SessionController::class, 'create'])->name('create');
Route::get('/login', [SessionController::class, 'index']);
Route::get('/create', [SessionController::class, 'register']);