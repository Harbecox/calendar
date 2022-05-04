<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",function (){
    return redirect("calendar");
});

Route::middleware("auth")->group(function (){
    Route::get('calendar', [\App\Http\Controllers\CalendarController::class,"index"])->name("calendar");
    Route::resource('project',\App\Http\Controllers\ProjectController::class);

    Route::prefix('project/{project_id}')->group(function (){
        Route::resource("task",\App\Http\Controllers\TaskController::class);
    });
});

Auth::routes();
