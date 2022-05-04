<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskToUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    function index(){
        $calendar = [];
        $users = User::all();
        foreach ($users as $user){
            $calendar[$user['id']] = [];
        }

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $tasks = Task::query()
            ->where("start","<=",$endOfWeek->toDateString())
            ->where("end",">=",$startOfWeek->toDateString())
            ->get();

        $task_ids = $tasks->map(function ($task){
            return $task->id;
        });
        $task_to_user = TaskToUser::query()->whereIn("task_id",$task_ids)->get();
        foreach ($task_to_user as $ttu){
            $task = $tasks->where("id",$ttu['task_id'])->first();
            $diff_start = Carbon::make($task->start)->diff($startOfWeek);
            $diff_end = Carbon::make($task->end)->diff($endOfWeek);
            $task->sdow = Carbon::make($task->start)->dayOfWeek - 1;
            $task->sdow = $task->sdow == -1 ? 7 : $task->sdow;
            if($diff_start->invert == 0){
                $task->sdow = 0;
            }
            $task->edow = Carbon::make($task->end)->dayOfWeek - 1;
            $task->edow = $task->edow == -1 ? 7 : $task->edow;
            if($diff_end->invert == 1){
                $task->edow = 7;
            }
            $calendar[$ttu['user_id']][] = $task;
        }
        foreach ($calendar as $u => $day){
            $data['calendar'][$u] = [
                "days" => $day,
                "user" => $users->where("id",$u)->first()
            ];
        }
        return view("calendar",$data);
    }
}
