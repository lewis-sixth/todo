<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class UserTasksController extends Controller
{

    public function store(User $user, Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:500'
        ]);

        $user->tasks()->create([
            'content' => $request->task,
            'priority' => $user->getNextTaskPriority()
        ]);

        return back();
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'tasks' => 'required|array'
        ]);

        $user->tasks()->delete();

        $tasks = collect($request->tasks)->map(function ($task, $key) {
            return [
                'content' => $task['content'],
                'priority' => $key
            ];
        });

        $user->tasks()->createMany($tasks);

        return back();
    }

    public function destroy(User $user, Task $task, Request $request)
    {
        $task->delete();

        return back();
    }
}
