<?php

namespace App\Http\Controllers;

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
        dd($request->all());
    }

    public function login(Request $request){
        return view('user.login');

    }
}
