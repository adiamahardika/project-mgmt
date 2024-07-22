<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
    $project->load('tasks');
    $totalTasks = $project->tasks->count();
    $completedTasks = $project->tasks->where('status', 'completed')->count();
    $inProgressTasks = $project->tasks->where('status', 'in progress')->count();
    $notStartedTasks = $project->tasks->where('status', 'not started')->count();

    $progressData = [
        'total' => $totalTasks,
        'completed' => $completedTasks,
        'inProgress' => $inProgressTasks,
        'notStarted' => $notStartedTasks,
    ];

    return view('projects.show', compact('project', 'progressData'));
    }

}

