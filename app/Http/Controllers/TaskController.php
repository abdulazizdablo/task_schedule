<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\TaskReorderRequest;
use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();
        $projects = Project::all();

        return view('tasks.index')->with('tasks', $tasks)->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {

        $project = Project::firstOrCreate(['name' => $request->project]);
        // Check if Project with same name exists in Database

        $task  = new Task();
        $task->name = $request->name;
        $task->priority = $request->priority;

        $project->tasks()->save($task);

        return back();
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTaskRequest $request, Task $task)
    {

        // use Dependency Injection to Model Binding with the desired task

        $task->update($request->validated());

        return to_route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }

    public function reorder(TaskReorderRequest $request, TaskService $task_service)
    {
        $new_task = $request->input('new_task');
        $previous_task = $request->input('previous_task');

        return $task_service->tasksReorder($new_task, $previous_task);
    }
}
