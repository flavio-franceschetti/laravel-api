@extends('layouts.app')

@section('content')
    <div class="my-1">

        <h3>Inserisci un nuovo progetto</h3>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ old('description') }}">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="github" class="form-label">Github</label>
                <input type="text" class="form-control" id="github" name="github" value="{{ old('github') }}">
                @error('github')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">Seleziona le tecnologie usate:</div>
            <div class="mb-3 btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $technology)
                    <input name="technologies[]" value="{{ $technology->id }}" type="checkbox" class="btn-check"
                        id="tech-{{ $technology->id }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
                @endforeach
            </div>

            {{-- thumb input --}}
            <div class="mb-3">
                <label for="thumb" class="form-label">Inserisci una thumb per il proggetto</label>
                {{-- onchange richiamo la funzione showThumb(event) --}}
                <input onchange="showThumb(event)" name="image_path" class="form-control" type="file" id="thumb">
                <img class="my-3" id="thumb-img" src="/img/placehold image.jpeg" alt="thumb">
            </div>

            <div>
                <label for="type">Tipo:</label>
                <select name="type_id" id="type" class="form-select my-3" aria-label="Default select example">
                    <option value="" selected>Seleziona il tipo...</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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
    </div>
@endsection


<script>
    // funzione javascript per mostrare l'anteprima della thumb caricata gli passo come argomanto l'evento change del form
    function showThumb(event) {
        // seleziono tramite l'id l'anteprima dell'immagine che deve essere cambiata
        const thumb = document.getElementById('thumb-img');
        // imposto l'src dell'immagine 
        //con event.target.files[0] accedon al primo e in questo caso unico file selezionato dall'utente nell elemento input
        // URL.createObjectURL con questa funzione creo un URL temporaneo che punta al file selezionato
        thumb.src = URL.createObjectURL(event.target.files[0])

    }
</script>
