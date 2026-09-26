<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of all tasks (View Tasks).
     */
    public function index(Request $request)
    {
        $query = Task::query();

        // Optional simple filter by status, used by the dashboard tabs
        if ($request->filled('status') && in_array($request->status, ['Pending', 'Completed'])) {
            $query->where('status', $request->status);
        }

        $tasks = $query->orderBy('due_date')->orderBy('created_at', 'desc')->get();

        $pendingCount = Task::pending()->count();
        $completedCount = Task::completed()->count();

        return view('tasks.index', compact('tasks', 'pendingCount', 'completedCount'));
    }

    /**
     * Show the form for creating a new task (Add Task).
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:Pending,Completed',
            'due_date'    => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    /**
     * Show the form for editing the specified task (Edit Task).
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in the database.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:Pending,Completed',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from the database (Delete Task).
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    /**
     * Quickly toggle / set a task's status (Update Status).
     */
    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Completed',
        ]);

        $task->update(['status' => $validated['status']]);

        return redirect()->route('tasks.index')->with('success', 'Task status updated!');
    }
}
