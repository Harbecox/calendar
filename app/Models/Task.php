<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    function users(){
        return $this->task_to_user->map(function ($ttu){
            return $ttu->user;
        });
    }

    function task_to_user(){
        return $this->hasMany(TaskToUser::class,"task_id","id");
    }

    function getStatusIdAttribute(){
        return $this->hasOne(TaskStatusHistory::class,"task_id",'id')->orderByDesc("created_at")->first()->status_id;
    }

    function history(){
        return $this->hasMany(TaskStatusHistory::class,"task_id","id");
    }

    function getIsOwnerAttribute(){
        return $this->task_to_user()->where("user_id",Auth::user()->id)->exists();
    }

}
