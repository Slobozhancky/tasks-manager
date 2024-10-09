<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $validateDataCategory = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Створюємо задачу
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($validateDataCategory['title']),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $tasks_statuses = DB::table('information_schema.COLUMNS')
            ->where('TABLE_NAME', 'tasks')
            ->where('COLUMN_NAME', 'status')
            ->pluck('COLUMN_TYPE')
            ->map(function ($type) {
                preg_match("/^enum\(('(.*?)',?)+\)$/", $type, $matches);
                return isset($matches[0]) ? array_map(function ($val) {
                    return trim($val, "'");
                }, explode(',', str_replace("'", "", substr($matches[0], 5, -1)))) : [];
            })->flatten();

        $categories = Category::query()->get();
        $category = Category::where('slug', '=', $request->slug)->first();
        $tasks = $category->tasks;

        return view('categories.show', ['tasks' => $tasks, 'category' => $category, 'categories' => $categories, 'statuses' => $tasks_statuses]);
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
    public function destroy(Request $request,)
    {
        $category = Category::findOrFail($request->id);
        $category->delete();

        return redirect()->route('dashboard')->with('success', "Category: " . $category->id . " was delete");
    }
}
