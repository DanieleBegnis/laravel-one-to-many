@extends('layouts.admin')

@section('content')
    <h3>Modifica il Progetto</h3>
    <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Titolo del progetto</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                value="{{ old('name', $project->name) }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="type_id" class="form-label">Tipo di progetto</label>
        <select class="form-select" aria-label="Default select example" id="type_id" name="type_id">
            <option value="">Scegli un tipo di progetto</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
        </select>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="client_name" class="form-label">Nome del Cliente</label>
            <input type="text" class="form-control" id="client_name" name="client_name" aria-describedby="emailHelp"
                value="{{ old('client_name', $project->client_name) }}">
        </div>
        @error('client_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating">
            <textarea class="form-control" id="summary" name="summary" style="height: 100px"
                value="{{ old('summary', $project->summary) }}"></textarea>
            <label for="summary">Descrizione del Progetto</label>
        </div>
        @error('summary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">

            @if ($project->project_thumbnail)
                <img src="{{ asset('storage/' . $project->project_thumbnail) }}" alt="">
            @endif

            <label for="project_thumbnail" class="form-label">Inserisci il Thumbnail del progetto</label>
            <input class="form-control" type="file" id="project_thumbnail" name="project_thumbnail">
        </div>

        <button type="submit" class="btn btn-primary my-3">Salva</button>
    </form>
@endsection
