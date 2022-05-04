@extends("layout")

@section("content")

    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-3"><h1>{{ $project->title }}</h1>
            <i>{{ $project->created_at }}</i></div>
        <div>{!! $project->description !!}</div>
        <div class="border-bottom"></div>

        <div class="row mb-5">
            @admin
            <div class="d-flex justify-content-end my-4">
                <a class="btn btn-success" href="{{ route("task.create",$project->id) }}">New Task</a>
            </div>
            @endadmin
            @foreach($project->tasks as $task)
                <div class="col-md-4">
                    <div class="card my-2">
                        <h5 @if($task->color) style="background-color:{{ $task->color }}" @endif class="card-header d-flex justify-content-between">#{{ $task->id }}
                            <div class="">
                                {{ \Carbon\Carbon::make($task->start)->format("m.d") }}
                                 -
                                {{ \Carbon\Carbon::make($task->end)->format("m.d") }}
                            </div>
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('task.show',[$project->id,$task->id]) }}" class="btn btn-primary">Show</a>
                                    @admin
                                    <a href="{{ route('task.edit',[$project->id,$task->id]) }}" class="btn btn-warning">Edit</a>
                                    @endadmin
                                </div>
                                <div>
                                    @foreach($task->users() as $user)
                                        <a href="{{ $user->id }}"></a>
                                        <img data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $user->name }}" style="width: 32px;" src="{{ $user->avatar }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
