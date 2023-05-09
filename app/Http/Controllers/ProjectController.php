<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request)
    {

        $project = Project::create([
            'name' => $request->name

        ]);
    }


    public function associatedTasks(Request $request)
    {
        $project = $request->input('project');
        $project = Project::where('project', $project)->with('tasks')->get();
        return response()
            ->view('project.associated_tasks', $project, 200);
    }
}
