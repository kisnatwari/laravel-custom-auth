<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register');
Route::view('/verify', 'auth.verify');


Route::post('/user-register', [AuthController::class, 'register'])->name('user-register');
Route::post('/user-login', [AuthController::class, 'login'])->name('user-login');
Route::post('/user-verify', [AuthController::class, 'verifyOTP'])->name('user-verify');
Route::any('/email-verify', [AuthController::class, 'authEmailVerify'])->name('email-verify');

Route::middleware(['auth'])->group(function(){
    Route::any('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['verifiedUser'])->group(function(){
    Route::view("/dashboard", 'dashboard');
});