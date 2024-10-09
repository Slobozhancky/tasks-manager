<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index(){
        return view('admin.index');
    }

    public function usersIndex(){
        $users = User::all();
        return view('admin.users.index', ['users' =>  $users]);
    }

    public function usersCreate(){
        return view('admin.users.create');
    }


    public function usersCreateStore(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'nullable|string',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

//        Auth::login($user);

        return redirect()->route('admin.users.index')->with('success', 'Users was created!!!');
    }

    public function usersEdit(Request $request){
        $user = User::query()->find($request->id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function usersUpdate(Request $request){

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $request->id,
            'role' => 'nullable|string',
            'password' => 'nullable|min:8'
        ]);

        $user = User::findOrFail($request->id);

        if (!empty($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }

        if (!empty($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }

        if (!empty($validatedData['role'])) {
            $user->role = $validatedData['role'];
        }

        // Оновлюємо пароль, якщо він вказаний
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', "User: " . $user->id . " updated
        successfully");
    }

    public function usersDestroy(Request $request){

        $user = User::findOrFail($request->id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User: " . $user->id . " was delete");
    }
}
