<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/All', [
            'projects' => Project::all(),
            'availableColors' => Project::getAvailableTextColors(),
            'availableIcons' => Project::getAvailableIcons(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'color' => [
                'required',
                'in:' . implode(',', Project::getAvailableTextColors())
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Project::getAvailableIcons())
            ],
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)->ignore($project->id)
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'color' => [
                'required',
                'in:' . implode(',', Project::getAvailableTextColors())
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Project::getAvailableIcons())
            ],
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
