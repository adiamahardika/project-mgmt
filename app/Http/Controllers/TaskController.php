<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:not started,in progress,completed',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projects.show', $project)
            ->with('success', 'Task added successfully.');
    }

    public function updateStatus(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'status' => 'required|in:not started,in progress,completed',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Task status updated successfully.');
    }
}

