<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [\App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');

Route::get('register', [UserController::class, 'create'])->name('user.create');
Route::post('register', [UserController::class, 'store'])->name('user.store');
Route::get('login', [UserController::class, 'login'])->name('login');

// 5. маршрут який буде вести на сторінку, з підтвердженням реєстрації
// 6. ну і треба піти зробити сам вид verify-email
// 7. В цьмоу роутері, є мідлвар, який вказує на те, що юзер має бути аутентифікованй, щоб його аутентифікувати, слід
// пити в UserController, та юзанути фасад Auth
Route::get('verify-email', function () {
    return view('user.verify-email');
})->middleware('auth')->name('verification.notice');

// 10. Це вже маршрут, буде оброблювати логіку після того, як юзер натисне підтвердити емейл
// fulfill - верифікує самого юзера
Route::get('verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 11. Маршрут для перевідправки посилання на верифікацію
// throttle - вказує на обмеження в одну хвилину, на прикладі це 3 запити в одну хвилину (ці показники можна міняти)
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:3,1'])->name('verification.send');
