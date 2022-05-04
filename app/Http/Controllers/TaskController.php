<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskToUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        $data['project'] = Project::find($project_id);
        $data['task'] = new Task();
        $data['task']->start = Carbon::now()->startOfWeek();
        $data['task']->end = Carbon::now()->endOfWeek();
        $data['action'] = route("task.store",$project_id);
        $data['method'] = "post";
        $data['users_ids'] = [];
        return view("project.task.edit",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$project_id)
    {
        $task = new Task();
        $task->description = $request->get("description");
        $task->project_id = $project_id;
        $task->title = $request->get("title");
        $task->start = $request->get("start");
        $task->color = $request->get("color");
        $task->end = $request->get("end");
        $task->save();

        foreach ($request->get("users") as $user_id){
            $ttu = new TaskToUser();
            $ttu->user_id = $user_id;
            $ttu->task_id = $task->id;
            $ttu->save();
        }
        return redirect()->route("project.show",$project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id,$id)
    {
        $data['project'] = Project::find($project_id);
        $data['task'] = Task::find($id);
        $data['users_ids'] = $data['task']->users()->map(function ($user){
            return $user->id;
        })->toArray();
        return view("project.task.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id,$id)
    {
        $data['project'] = Project::find($project_id);
        $data['task'] = Task::find($id);
        $data['users_ids'] = $data['task']->users()->map(function ($user){
            return $user->id;
        })->toArray();
        $data['action'] = route("task.update",[$project_id,$id]);
        $data['method'] = "put";
        return view("project.task.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id,$id)
    {
        $task = Task::find($id);
        $task->description = $request->get("description");
        $task->title = $request->get("title");
        $task->start = $request->get("start");
        $task->color = $request->get("color");
        $task->end = $request->get("end");
        $task->save();

        TaskToUser::query()->where("task_id",$id)->delete();
        foreach ($request->get("users") as $user_id){
            $ttu = new TaskToUser();
            $ttu->user_id = $user_id;
            $ttu->task_id = $id;
            $ttu->save();
        }
        return redirect()->route("project.show",$project_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
