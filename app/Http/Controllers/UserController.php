<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        User::create($request->all());

        return redirect()->route('login')->with('success', 'Registration true');


    }

    public function login(Request $request){
        return view('user.login');

    }
}
