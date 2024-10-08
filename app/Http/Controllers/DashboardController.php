<?php

namespace App\Http\Controllers;

use App\Models\Task\Category;
use App\Models\Task\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks_status = DB::table('information_schema.COLUMNS')
            ->where('TABLE_NAME', 'tasks')
            ->where('COLUMN_NAME', 'status')
            ->pluck('COLUMN_TYPE')
            ->map(function ($type) {
                preg_match("/^enum\(('(.*?)',?)+\)$/", $type, $matches);
                return isset($matches[0]) ? array_map(function ($val) {
                    return trim($val, "'");
                }, explode(',', str_replace("'", "", substr($matches[0], 5, -1)))) : [];
            })->flatten();

        $categories = Category::query()->where('user_id', auth()->user()->id)->get(['title', 'id']);
        $tasks = Task::query()->where('user_id', auth()->user()->id)->get();

        return view('dashboard', ['statuses' => $tasks_status, 'categories' => $categories, 'tasks' => $tasks]);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
