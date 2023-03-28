<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('welcome', ['user' => $user]);
})->name('dashboard');

use App\Http\Controllers\UserController;

Route::get('/user/register', [UserController::class, 'register'])->name('user.register');
Route::get('/user/login', [UserController::class, 'login'])->name('user.login');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/user', [UserController::class, 'store']);
