<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('registration', [RegisterController::class, 'showForm'])->middleware('guest')->name('registration');
Route::post('registration', [RegisterController::class, 'createUser'])->name('registration');

Route::get('login', [LoginController::class, 'showForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function (){

   Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
   Route::get('/users', [\App\Http\Controllers\Admin\AdminController::class, 'usersIndex'])->name('admin.users.index');

   Route::get('/users/create', [\App\Http\Controllers\Admin\AdminController::class, 'usersCreate'])->name('admin.users.create');
   Route::post('/users/create', [\App\Http\Controllers\Admin\AdminController::class, 'usersCreateStore'])->name('admin.users.store');

   Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\AdminController::class, 'usersEdit'])->name('admin.users.edit');
   Route::put('/users/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'usersUpdate'])->name('admin.users.update');
   Route::post('/users/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'usersDestroy'])->name('admin.users.destroy');

})->middleware('role:admin');
