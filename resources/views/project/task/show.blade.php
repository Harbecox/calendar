@extends("layout")

@section("content")

    <div class="container">

            <div class="d-flex justify-content-between align-items-end my-3">
                <div>
                    <h1>{{ $task->title }}</h1>
                    <h4><a href="{{ route("project.show",$project->id) }}">{{ $project->title }}</a></h4>
                </div>
                <h4>
                    {{ \Carbon\Carbon::make($task->start)->format("Y.m.d") }}
                    -
                    {{ \Carbon\Carbon::make($task->end)->format("Y.m.d") }}
                </h4>
            </div>
            <div>{!! $task->description !!}</div>
            <div class="my-4">
                <h2>Developers</h2>
                <div class="row">
                    @foreach($task->users() as $user)
                        <div class="col-2">
                            <div class="card h-100">
                                <img class="card-img-top mt-2" src="{{ $user->avatar }}" style="width: 128px;margin: 0 auto;">
                                <div class="card-body">
                                    <h5 class="card-title text-center h-100">{{ $user->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

    </div>
@endsection
