@extends('layouts.app')


@section('content')
    @extends('layouts.app')

@section('content')
    <h3>Modifica il progetto</h3>
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <input type="text" class="form-control" id="description" name="description"
                value="{{ $project->description }}">
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="github" class="form-label">Github</label>
            <input type="text" class="form-control" id="github" name="github" value="{{ $project->github }}">
            @error('github')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-2">Seleziona le tecnologie usate:</div>
        <div class="mb-3 btn-group" role="group" aria-label="Basic checkbox toggle button group">
            @foreach ($technologies as $technology)
                <input {{-- @checked($project->technologies->contains($technology))  --}} {{-- @checked(in_array($technology->id, $project->technologies()->pluck('id')->toArray())) --}} @checked(in_array($technology->id, old('technologies', $project->technologies->pluck('id')->toArray()))) name="technologies[]"
                    value="{{ $technology->id }}" type="checkbox" class="btn-check" id="tech-{{ $technology->id }}"
                    autocomplete="off">
                <label class="btn btn-outline-primary" for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="thumb" class="form-label">Inserisci una thumb per il proggetto</label>
            <input name="image_path" class="form-control" type="file" id="thumb">
        </div>

        <div>
            <label for="type">Tipo:</label>
            <select name="type_id" id="type" class="form-select my-3" aria-label="Default select example">
                <option value="" selected>Seleziona il tipo...</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{-- @if (old('type_id', $project->type_id) == $type->id) selected @endif --}} @selected(old('type_id', $project->type_id) == $type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                In progress
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Done
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-warning">Annulla</button>
    </form>
@endsection


@endsection
