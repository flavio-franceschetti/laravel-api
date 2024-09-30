@extends('layouts.app')


@section('content')
    <h2>Gestione delle tipologie dei progetti</h2>
    {{-- creo un form per la creazione di una nuova tipologia assegnabile --}}
    <form class="d-flex gap-3 my-4" action="{{ route('admin.types.store') }}" method="POST">
        @csrf
        <input name="name" type="text" class="new-type-input form-control" id="new-type" placeholder="Crea un nuovo tipo">

        <button type="submit" class="btn btn-success">Crea</button>
    </form>

    <hr>
    {{-- creo una lista per visualizzare tutti i tipi che possono essere assegnati ai vari progetti e per poterli modificare e cancellare  --}}
    <ul class="list-group my-4">
        @foreach ($types as $type)
            <li class="d-flex justify-content-between list-group-item">
                <div>
                    {{ $type->name }}
                </div>
                <div>
                    <a class="btn text-white btn-warning" href="#"><i
                            class="fa-solid fa-pen-to-square"></i>Aggiorna</a>
                    <form class="d-inline" onsubmit="return confirm('Sicuro di voler eliminare?')"
                        action="{{ route('admin.types.destroy', $type) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>
@endsection
