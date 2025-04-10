<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks with optional filters.
     */
    public function index(Request $request)
    {
        $query = Task::with('employee');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        $tasks = $query->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.tasks.create', compact('employees'));
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display a specific task.
     */
    public function show(Task $task)
    {
        if (auth()->user()->role === 'employee' && auth()->user()->id !== $task->assigned_to) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing a task.
     */
    public function edit(Task $task)
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.tasks.edit', compact('task', 'employees'));
    }

    /**
     * Update a task's details.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'deadline' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Delete a task.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    /**
     * Employee can update only the status of their own task.
     */
    public function updateStatus(Request $request, Task $task)
    {
        if (auth()->user()->id !== $task->assigned_to) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Task status updated.');
    }
}
