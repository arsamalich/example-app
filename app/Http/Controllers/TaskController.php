<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
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
        'description' => 'nullable|string',
        'status' => 'required|in:pending,completed',
    ]);

     Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
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
    public function edit($id)
    {
        $task = Task::findOrFail($id);
    return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,completed',
    ]);

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    /**
     * Show tasks in dashboard.
     */
    public function dashboard()
    {
        $tasks = Task::latest()->get();

        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $completedTasks = Task::where('status', 'completed')->count();

        return view('dashboard', compact('tasks', 'totalTasks', 'pendingTasks', 'completedTasks'));
    }


}
