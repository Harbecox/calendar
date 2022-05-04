@extends("layout")

@section("content")

    <div class="container">
       <form method="post" action="{{ $action }}">
           @method($method)
           @csrf
           <div class="d-flex justify-content-between align-items-end my-3">
               <div>
                   <h4><a href="{{ route("project.show",$project->id) }}">{{ $project->title }}</a></h4>
                   <h1><input class=" form-control" placeholder="Task Title" name="title" value="{{ $task->title }}"></h1>
                   <input type="color" name="color">
               </div>
               <div>
                   <input name="start" type="date" value="{{ \Carbon\Carbon::make($task->start)->format("Y-m-d") }}">
                   <input name="end" type="date" value="{{ \Carbon\Carbon::make($task->end)->format("Y-m-d") }}">
               </div>
           </div>
           <div><textarea name="description">{!! $task->description !!}</textarea></div>

           <div class="my-2">
               <label for="#select_users">Users</label>
               <select id="select_users" class="select2 form-control" name="users[]" multiple="multiple">
                   @foreach(\App\Models\User::all() as $user)
                       <option value="{{ $user->id }}" @if(in_array($user->id,$users_ids)) selected @endif>
                           {{ $user->name }}
                       </option>
                   @endforeach
               </select>
           </div>

           <div class="float-end my-3">
               <button type="submit" class="btn btn-primary">Save</button>
           </div>
       </form>
    </div>
@endsection
