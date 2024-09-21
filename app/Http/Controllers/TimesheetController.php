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
    public function index()
    {
        $timesheets = Timesheet::all();
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
