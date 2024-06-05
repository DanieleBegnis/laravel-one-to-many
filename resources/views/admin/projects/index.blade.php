@extends('layouts.admin')

@section('content')
    <h3>Ecco qui tutte le tue Repositories!</h3>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Client Name</th>
                <th scope="col">Created At</th>
                <th scope="col">More Info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td> <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">Show more</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
