<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use App\Models\TaskToUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Vladimir";
        $user->email = "harbecox@gmail.com";
        $user->password = "$2y$10$9DU61JBeCRnoEYFprMgXYu07OmhLHoFGM1PE43nC7IniWmYM6SkiW";
        $user->admin = true;
        $user->save();

        $users = [
            "Yelena",
            "Alisa",
            "Meline",
            "Ani",
            "Taron",
            "Vanik",
            "Emma",
        ];

        \App\Models\User::factory(7)->make()->each(function ($item) use(&$users){
            $item->name = array_pop($users);
            $item->save();
        });

        $task_status = new TaskStatus();
        $task_status->title = "In work";
        $task_status->save();

        $task_status = new TaskStatus();
        $task_status->title = "New";
        $task_status->save();

        $task_status = new TaskStatus();
        $task_status->title = "Completed";
        $task_status->save();

//        $users = User::all();

//        $projects = \App\Models\Project::factory(10)->create();
//        $tasks = [];
//        for($i = 1;$i <= 15;$i++){
//            $project_id = $projects->random(1)->first()->id;
//            $tasks[] = \App\Models\Task::factory(1)->create(['project_id' => $project_id])->first();
//        }
//        foreach ($tasks as $task){
//            for($i = 0;$i < rand(1,3);$i++){
//                $task_to_user = new TaskToUser();
//                $task_to_user->user_id = $users->random(1)->first()->id;
//                $task_to_user->task_id = $task->id;
//                $task_to_user->save();
//            }
//        }


    }
}
