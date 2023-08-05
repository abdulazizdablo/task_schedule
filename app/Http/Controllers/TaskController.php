<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all()->sortBy('priority');
        $projects = Project::all();

        return view('task.index')->with('tasks', $tasks)->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {



        $project_name = $request->project;

        $project = Project::firstOrNew(['name' => $project_name]);
        // Check if Project with same name exists in Database


        $task  = new Task();
        $task->name = $request->name;
        $task->priority = $request->priority;



        if (!$project->exists) {


            $project->save();

            $project->tasks()->save($task);
        } else {



            $project->tasks()->save($task);
        }

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        $request->validate([
            'name' => 'required|max:30',
            'priority' => 'required|digits_between:1,6|min:0|unique:tasks,priority|max:30'

        ]);


        // use Dependency Injection to Model Binding with the desired task

        $task->update($request->all());

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }
    public function reorder(Request $request)
    {


        $new_task = $request->input('new_task');
        $previous_task = $request->input('previous_task');



        $task_one = Task::where('priority', $new_task)->first();

        $task_two = Task::where('priority', $previous_task)->first();






        tap($task_one)->update(['priority' => $task_two->priority]);




        tap($task_two)->update(['priority' => $new_task]);



        if ($task_one && $task_two) {








            return response()->json([

                'task_one_priority' => (int)$task_one->priority,
                'task_two_priority' => (int)$task_two->priority
            ]);
        }
    }
}
