<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{





    public function associatedTasks(Request $request)
    {
        
       $project = Project::with('tasks')->where('name',$request->input('project'))->first();
        $view =  view('project.associated_tasks')->with('project', $project)->render();
        return response()->json(['success' => true, 'html' => $view]);
    }
}
