<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskReorderService
{

    public function tasksReorder(int $task1, int  $task2): JsonResponse

    {

        $task_one_db = Task::where('priority', $task1,)->first();

        $task_two_db = Task::where('priority', $task2)->first();


        tap($task_one_db)->update(['priority' => $task_two_db->priority]);


        tap($task_two_db)->update(['priority' => $task1]);



        if ($task_one_db && $task_two_db) {

            return response()->json([

                'task_one_priority' => (int)$task_one_db->priority,
                'task_two_priority' => (int)$task_two_db->priority
            ]);
        }
    }
}
