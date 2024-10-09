<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Створюємо задачу
        Category::create([
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($request->id);

        if (!empty($validatedData['title'])) {
            $category->title = $validatedData['title'];
        }

        $category->save();

        return redirect()->route('dashboard')->with('success', 'Category was' . $category->id . 'update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request,)
    {
        $category = Category::findOrFail($request->id);
        $category->delete();

        return redirect()->route('dashboard')->with('success', "Category: " . $category->id . " was delete");
    }
}
