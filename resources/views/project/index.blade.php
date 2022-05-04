@extends("layout")

@section("content")
    <div class="container">
        <div class="d-flex justify-content-end">
            @admin
            <a class="btn btn-success" href="{{ route("project.create") }}">Add project</a>
            @endadmin
        </div>
        <table class="table">
            <tr>
                <th>Title</th>
                <th class="text-center">Tasks</th>
                <th class="text-end">Create</th>
                <th class="text-end">Actions</th>
            </tr>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td class="text-center">{{ $project->tasks->count() }}</td>
                    <td class="text-end">{{ $project->created_at }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary mx-1" href="{{ route("project.show",$project->id) }}">Show</a>
                            @admin
                                <a class="btn btn-warning mx-1" href="{{ route("project.edit",$project->id) }}">edit</a>
                            @endadmin
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
