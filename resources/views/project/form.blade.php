@extends("layout")

@section("content")
    <div class="container">
        <x-larastrap::form :obj="$project" :action="$action">
            @method($method)
            <x-larastrap::hidden name="id" />
            <x-larastrap::number name="id" label="ID" disabled="true" />
            <x-larastrap::text name="title" label="Title" />
            <x-larastrap::textarea rows="12" name="description" label="description" />
        </x-larastrap::form>
    </div>
@endsection
