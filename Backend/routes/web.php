<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ChatController;

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

Route::get('/api/csrf-token', function() {
    return response()->json([
        'csrf_token' => csrf_token()
    ]);
});

Route::post('/login-by-form', [UserController::class, 'loginFrom'])->name('login.by.form');

Route::post('/login-by-google', [UserController::class, 'loginByGoogle'])->name('login.by.google');
//route logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//rute chatgpt
Route::post('/scnd-chat', [ChatController::class, 'scndChat'])->name('scnd-chat');
