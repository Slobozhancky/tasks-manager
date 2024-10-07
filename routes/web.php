<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('registration', [RegisterController::class, 'showForm'])->name('registration');
    Route::post('registration', [RegisterController::class, 'createUser'])->name('registration');

    Route::get('login', [LoginController::class, 'showForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware(['check.auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');

    Route::get('/users/create', [AdminController::class, 'usersCreate'])->name('admin.users.create');
    Route::post('/users/create', [AdminController::class, 'usersCreateStore'])->name('admin.users.store');

    Route::get('/users/{id}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');
    Route::post('/users/{id}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');
});

Route::middleware('auth')->group(function () {
    // Додайте всі маршрути для авторизованих користувачів тут
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Наприклад, маршрут до dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Додайте інші маршрути для авторизованих користувачів
//    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
//    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});








