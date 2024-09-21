<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController
{
    // Store a new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:ongoing,completed,on_hold',
        ]);

        $project = Project::create($validated);
        return response()->json(['message' => 'Project created successfully', 'project' => $project]);
    }

    // Get all projects
    public function index(Request $request)
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    // Get a specific project by ID
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json($project);
    }

    // Update a project
    public function update(Request $request)
    {
        $project = Project::find($request->id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->update($request->all());
        return response()->json(['message' => 'Project updated successfully', 'project' => $project]);
    }

    // Delete a project
    public function destroy(Request $request)
    {
        $project = Project::find($request->id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->timesheets()->delete();  // Delete related timesheets
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
