<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('register', [UserController::class, 'create'])->name('user.create');
Route::post('register', [UserController::class, 'store'])->name('user.store');
Route::get('login', [UserController::class, 'login'])->name('login');
