<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

//        dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed,canceled', // Статуси
            'deadline' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);


        // Створюємо задачу
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            "status" => $request->status,
            "deadline" => $request->deadline,
            'user_id' => Auth::id(), // Зберігаємо ID авторизованого користувача
        ]);

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
