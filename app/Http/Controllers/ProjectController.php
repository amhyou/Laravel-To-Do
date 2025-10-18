<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    
    // Show all projects for the logged-in user
    public function index()
    {
        $projects = auth()->user()->projects()->with('tasks')->latest()->get();
        
        return Inertia::render('Projects/Index', [
            'projects' => $projects
        ]);
    }

    // Show form to create a new project
    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    // Store a new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    // Show a single project with its tasks
    public function show(Project $project)
    {
        // Make sure the project belongs to the logged-in user
        $this->authorize('view', $project);
        
        $project->load('tasks');
        
        return Inertia::render('Projects/Show', [
            'project' => $project
        ]);
    }

    // Show form to edit a project
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        
        return Inertia::render('Projects/Edit', [
            'project' => $project
        ]);
    }

    // Update a project
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    // Delete a project
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}