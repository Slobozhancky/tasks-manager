<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    /** TODO 15. Метод щоб розлогінити юзера */
    public function logout(Request $request){

        Auth::logout();

        return redirect()->route('login');

    }
}
