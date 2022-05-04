<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
