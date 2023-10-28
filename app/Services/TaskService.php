<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskService
{

    public function tasksReorder(int $new_task, int $previous_task): JsonResponse

    {

        $task_one_db = Task::where('priority', $new_task,)->first();


        $task_two_db = Task::where('priority', $previous_task)->first();


        $task_one_db->update(['priority' => $previous_task]);


        $task_two_db->update(['priority' => $new_task]);



        if ($task_one_db && $task_two_db) {

            return response()->json([

                'task_one_priority' => (int)$previous_task,
                'task_two_priority' => (int)$new_task
            ]);
        }
    }
}
