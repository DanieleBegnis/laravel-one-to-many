@extends('layouts.admin')

@section('content')
    <h3>{{ $project->name }}</h3>
    @if ($project->type)
        <h5>Tipo di Progetto: {{ $project->type->type }}</h5>
    @endif


    @if ($project->project_thumbnail)
        <img src="{{ asset('storage/' . $project->project_thumbnail) }}" alt="">
    @endif

    <p>{{ $project->summary }}</p>

    <p>Progetto per: {{ $project->client_name }}</p>

    <p>Creato il: {{ $project->created_at }}</p>

    <p>Aggiornato il: {{ $project->updated_at }}</p>

    <h4>Modifica il post</h4>

    <div class="row">
        <div class="col-6">
            <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">Edit</a>
        </div>
        <div class="col-6">
            <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Elimina il Progetto</button>
            </form>
        </div>
    </div>
@endsection
