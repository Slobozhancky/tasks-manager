<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('registration', [UserController::class, 'create'])->name('registration');
Route::post('/create', [UserController::class, 'store']);
Route::get('login', [UserController::class, 'login'])->name('login');
