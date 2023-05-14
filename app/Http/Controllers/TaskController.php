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
        /* $task = Task::create([

            'name' => $task_request->name,
            'priority' => $task_request->priority



        ]);*/



        /* $task_data = [

            'name' => $task_request->name,
            'priority' => $task_request->priority



        ];*/
        //  $task = new Task($task_data);

        /*$task_data =[
            'name' => $task_request->name,
            'priority' => $task_request->priority


        ];*/

        // $task = new Task($task_data);

        $project_name = $task_request->project;
        //$project = new Project();
        // $project->project = $project_name;
        $project = Project::firstOrNew(['project' => $project_name]);
        //$task->project_id = $project->id;
        //  $task->save();
        //dd($project->id);
        /*$task = new Task();
        $task->name = $task_request->name;
        $task->priority = $task_request->priority;*/

        if (!$project->exists) {
            $project_tasks = [$task_request->name];
            $project->tasks = $project_tasks;
            $project->save();
            $project->tasks()->create([ /*'project' => $project_name, 'tasks' => $project_tasks*/
                'project_id' => $project->id,
                'name' => $task_request->name,
                'priority' => $task_request->priority,
            ]);
        } else {
            //$project->tasks->push($task->name);


            $task = Task::create([
                'project_id' => $project->id,

                'name' => $task_request->name,
                'priority' => $task_request->priority



            ]);

            $project->tasks = array_merge($project->tasks, (array)$task_request->name);
            //array_push( $p_tasks, $task->name);
            // dd($p_tasks );
            //$project->tasks->update( $p_tasks);
            //$project->save();
            // $project->save();
            $project->update([

                'tasks' => $project->tasks

            ]);
            //$project->tasks()->update(['project_id' => $project->id] );


            //if($project->tasks()->exists()){

            //dd($project->tasks());
            //array_push($project->tasks,$task->name);

            //$task->project()->update([ 'tasks' => $project->tasks]);





            /*  $project_tasks = [$task_request->name];
            $project->tasks = $project_tasks;
            $project->save();
            $project->tasks()->create([ /*'project' => $project_name, 'tasks' => $project_tasks*/
            /* 'project_id' => $project->id,
                'name' => $task_request->name,
                'priority' => $task_request->priority,*/
            /* ]);*/
        }


        // $project = Project::where('project', $project_name)->first();
        /*Task::find($id)->users()->save($user);*/
        //$project_tasks = array_push($project->tasks, $project_name);


        // $task->project()->update(['project' => $project_name, 'tasks' => $project_tasks]);

        //if ($project->tasks()->exists()) {
        /*$project = Project::updateOrCreate(
    ['project' =>   $project_name ],
    ['tasks' => array_merge($project_tasks, (array)$project_name)]


   
)*/

        //$project_tasks = array_merge($project->tasks,(array) $project_name);


        //$task->project()->update(['project' => $project_name, 'tasks' => $project_tasks]);
        //}

        //$task->project()->update(['project' => $project_name, 'tasks' => $task->name]);







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


        $new_task = request('new_task');
        $previous_task = request('previous_task');

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
