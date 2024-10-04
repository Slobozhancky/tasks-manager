<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

        // 2. Знаходимо користувача за ID
        $user = User::findOrFail($request->id);

        // 3. Оновлюємо дані користувача
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

        // Зберігаємо зміни
        $user->save();

        // 4. Редірект з повідомленням про успішне оновлення
        return redirect()->route('admin.users.index')->with('success', "User: " . $user->id . " updated
        successfully");
    }

    public function usersDestroy(Request $request){

        $user = User::findOrFail($request->id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User: " . $user->id . " was delete");
    }
}
