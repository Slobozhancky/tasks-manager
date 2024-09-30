<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        return response('Hello user', 200);
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){


        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255'],
        ]);

        // TODO: 1. Створюємо екземпляр класу, щоб потім взаємодіяти з верифікацією через email */
        $user = User::create($request->all());

        // TODO 2. Створюємо івент який буде вказувати на те, що користувача створено */
        event(new Registered($user));

        /** TODO 3. Треба також перевірити, щоб в базі в таблиці users було поле email_verified_at, якщо немає треба
         оновити табличку через міграцію */

        /** TODO 4. ідемо в марштрути і там створюємо три маршрути */

        /** TODO 8. Ось цей фасад за який і говорив, для аутентифікації, тобто коли реєстрація пройшла, щоб юзера було
         * відразу аутентифіковано */
        Auth::login($user);

        /** TODO 9. Ну і редіректимо юзера на сторінку, з інфою про верифікацію resources/views/user/verify-email.blade
         * .php
         */
        return redirect()->route('verification.notice');


    }

    public function login(Request $request){
        return view('user.login');

    }

    // TODO 18. тут будемо приймати дані які прийдуть зі сторінки login
    public function loginAuth(Request $request){

    // TODO 22. Тут приклад аутентифікації за EMAIL, але якщо нам треба аутентифікувати по ЛОГІНУ, то все тупо так само
        // але валідувати будемо не email, а login
        $credentials = $request->validate([
           'email' => ['required', 'email'],
           'password' => ['required']
        ]);

    // TODO 21. attempt відповідає за те, щоб отримати дані з бази і залогінити юзера. Перший параметр це щоб
        // передати дані, а другий, це щоб вказати чи слід запамятати його в системі. А переконати в цьому можна,
        // якщо піти в консоль розробника та в Application ми можемо побачити, що юзеру створить додатково куку
        if(Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Welcome, ' . Auth::user()->name);
        }

        return back()->withErrors([
           'email' => 'Login or email is not correct!'
        ]);
    }

    // TODO 22. Дока по тому як відновити пароль: https://laravel.com/docs/11.x/passwords
    public function resetPassword(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

    // TODO 24. В нас властивість success, бо саме її використовуємо для флеш повідомлень
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /** TODO 15. Метод щоб розлогінити юзера */
    public function logout(Request $request){

        Auth::logout();

        return redirect()->route('login');

    }
}
