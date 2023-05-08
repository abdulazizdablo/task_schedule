<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all()->sortBy('priority');

        return view('task.index')->with('tasks', $tasks);

   
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
        Task::create([

            'name' => $task_request->name,
            'priority' => $task_request->priority



        ]);
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit')->with('task',$task);
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
        

        $new_task = request('new_task');
        $previous_task = request('previous_task');
 
// $task_one


       $task_one = Task::where('priority', $new_task)->first();

       $task_two = Task::where('priority', $previous_task)->first();


        tap($task_one)->update(['priority' => $task_two->priority]);
        tap($task_two)->update(['priority' => $new_task ]);
if ($task_one && $task_two){

      
    return response()->json([

        'task_one_priority' => (int)$task_one->priority,
        'task_two_priority' => (int)$task_two->priority
    ]);


}
      
        /*$task_one->update([
    'name' => $task_two->name,
    'priority' => $task_two->priority,
    'created_at' => $task_two->created_at,
    'updated_at' => $task_two->updated_at

]);
*/
        /*$task_two->update([
    $task_one
]);*/



        /*$reorder_tasks = json_decode();*/
  
    }

}
