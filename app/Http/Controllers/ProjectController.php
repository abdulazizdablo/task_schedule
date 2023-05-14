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
        $project_selected = $request->input('project');
        $project = Project::where('project', $project_selected)->with('tasks')->first();
        //$project = Project::with('tasks')->all();
        $view =  view('project.associated_tasks')->with('project', $project)->render();
        return response()->json(['success' => true, 'html' => $view]);
    }
}
