<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status', 'all');
        
        $query = Task::where('user_id', $user->id);
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $tasks = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get counts for different statuses
        $counts = [
            'todo' => Task::where('user_id', $user->id)->where('status', 'todo')->count(),
            'backlog' => Task::where('user_id', $user->id)->where('status', 'backlog')->count(),
            'in_progress' => Task::where('user_id', $user->id)->where('status', 'in_progress')->count(),
            'completed' => Task::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];
        
        return Inertia::render('tasks/index', [
            'tasks' => $tasks,
            'counts' => $counts,
            'current_status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return Inertia::render('tasks/create');
    }

    /**
     * Store a newly created task.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     */
    public function show(Request $request, Task $task)
    {
        // Ensure task belongs to authenticated user
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('tasks/show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Request $request, Task $task)
    {
        // Ensure task belongs to authenticated user
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('tasks/edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified task.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Ensure task belongs to authenticated user
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $task->update($request->validated());

        return redirect()->route('tasks.show', $task)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task.
     */
    public function destroy(Request $request, Task $task)
    {
        // Ensure task belongs to authenticated user
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}