<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// TODO 16. Мідлвар, котрий буде працювати для НЕ залогінених юзерів
Route::middleware('guest')->group(function (){
    Route::get('register', [UserController::class, 'create'])->name('user.create');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('loginAuth');
});

// TODO 17. Мідл вар котрий буде працювати, якщо юзер аутентифікований і верифікований
Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('dashboard', [\App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');
});



/* TODO 12. Створимо групу маршрутів для мідлварів, щоб не робити ці мідл вари на кожному роутів */
/* TODO 13. Далі наступним кроком буде налаштування файлу .env, а саме буде мо юзати  https://mailtrap.io/, щоб
 * взяти параметри дял відправки мейлів
 *
 * Налаштування знайходяться в розділі Email testing - Inboxes - SMTP і далі
 *  обираємо PHP - Laravel 9+
 */

Route::middleware('auth')->group(function (){
    /**
     * TODO 5. маршрут який буде вести на сторінку, з підтвердженням реєстрації
     * TODO 6. ну і треба піти зробити сам вид verify-email
     * TODO 7. В цьмоу роутері, є мідлвар, який вказує на те, що юзер має бути аутентифікованй, щоб його
     * аутентифікувати, слід
     * пити в UserController, та юзанути фасад Auth */

        Route::get('verify-email', function () {
            return view('user.verify-email');
        })->middleware('auth')->name('verification.notice');

     /**
      * TODO 10. Це вже маршрут, буде оброблювати логіку після того, як юзер натисне підтвердити емейл
      * fulfill - верифікує самого юзера */
        Route::get('verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();

            return redirect()->route('dashboard');
        })->middleware(['auth', 'signed'])->name('verification.verify');

    /** TODO 11. Маршрут для перевідправки посилання на верифікацію
        * throttle - вказує на обмеження в одну хвилину, на прикладі це 3 запити в одну хвилину (ці показники можна міняти) */
     Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
     })->middleware(['auth', 'throttle:3,1'])->name('verification.send');

    /** TODO 14.  Налаштуємо вихід для користувачів, але цей вихід має бути доступним, саме для авторизованих юзерів*/
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
 });
