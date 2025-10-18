<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    // Store a new task in a project
    public function store(Request $request, Project $project)
    {
        // Make sure user owns the project
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        $project->tasks()->create($validated);

        return redirect()->back()
            ->with('success', 'Task created successfully!');
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        // Make sure user owns the project that contains this task
        if ($task->project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_completed' => 'boolean'
        ]);

        $task->update($validated);

        return redirect()->back()
            ->with('success', 'Task updated successfully!');
    }

    // Toggle task completion status
    public function toggleComplete(Task $task)
    {
        if ($task->project->user_id !== auth()->id()) {
            abort(403);
        }

        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return redirect()->back();
    }

    // Delete a task
    public function destroy(Task $task)
    {
        if ($task->project->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->back()
            ->with('success', 'Task deleted successfully!');
    }
}