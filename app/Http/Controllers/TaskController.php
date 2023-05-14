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
    public function store(TaskRequest $task_request)
    {

        $project_name = $task_request->project;

        $project = Project::firstOrNew(['project' => $project_name]);
        // Check if Project with same name exists in Database

        if (!$project->exists) {
            $project_tasks = [$task_request->name];
            $project->tasks = $project_tasks;
            $project->save();
            $project->tasks()->create([
                'project_id' => $project->id,
                'name' => $task_request->name,
                'priority' => $task_request->priority,
            ]);
        } else {



            Task::create([
                'project_id' => $project->id,
                'name' => $task_request->name,
                'priority' => $task_request->priority

            ]);

            $project->tasks = array_merge($project->tasks, (array)$task_request->name);
            $project->update([

                'tasks' => $project->tasks

            ]);
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
    public function update(TaskRequest $task_request, Task $task)
    {

        // use Dependency Injection to Model Binding with the desired task

        $task->update([
            'name' => $task_request->name,
            'priority' => $task_request->priority


        ]);

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

        // $task_one


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
