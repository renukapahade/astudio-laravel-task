<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController
{
    // Store a new timesheet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hours' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        $timesheet = Timesheet::create($validated);

        return response()->json(['message' => 'Timesheet logged successfully', 'timesheet' => $timesheet]);
    }

    // Get all timesheets
    public function index(Request $request)
    {
        $query = Timesheet::query(); // Initialize the query for the Timesheet model

        // Apply filters only if they exist in the request
        if ($request->has('task_name')) {
            $query->where('task_name', 'LIKE', '%' . $request->input('task_name') . '%'); // Partial matching
        }

        if ($request->has('date')) {
            $query->where('date', $request->input('date'));
        }

        if ($request->has('hours')) {
            $query->where('hours', $request->input('hours'));
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->has('project_id')) {
            $query->where('project_id', $request->input('project_id'));
        }

        // Execute the query and get the results
        $timesheets = $query->get();

        return response()->json($timesheets);
    }

    // Get a specific timesheet by ID
    public function show($id)
    {
        $timesheet = Timesheet::find($id);

        if (!$timesheet) {
            return response()->json(['error' => 'Timesheet not found'], 404);
        }

        return response()->json($timesheet);
    }

    // Update a timesheet
    public function update(Request $request)
    {
        $timesheet = Timesheet::find($request->id);

        if (!$timesheet) {
            return response()->json(['error' => 'Timesheet not found'], 404);
        }

        $timesheet->update($request->all());
        return response()->json(['message' => 'Timesheet updated successfully', 'timesheet' => $timesheet]);
    }

    // Delete a timesheet
    public function destroy(Request $request)
    {
        $timesheet = Timesheet::find($request->id);

        if (!$timesheet) {
            return response()->json(['error' => 'Timesheet not found'], 404);
        }

        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted successfully']);
    }
}
