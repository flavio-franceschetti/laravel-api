@extends('layouts.app')

@section('content')
    {{-- @if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    {{$message}}
  </div>
@endif --}}
    @if ($message = Session('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <h3>Lista {{ $projectCount }} progetti </h3>
    <form action="{{ route('admin.projects.index') }}" method="GET">
        <input type="text" name="search" id="search" placeholder="Ricerca il progetto">
        <button type="submit" class="btn btn-success">Cerca</button>
    </form>
    <table class="table">
        <tdead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Thumb</th>
                <th scope="col">Nome</th>
                <th scope="col">Data di creazione</th>
                <th scope="col">Status</th>
                <th scope="col">Type</th>
                <th scope="col">Tecnologie</th>
                <th scope="col">Azioni</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>
                            <img class="thumb-img"
                                src="{{ $project->image_path ? asset('storage/' . $project->image_path) : '/img/placehold image.jpeg' }}"
                                alt="{{ $project->img_original_name }}">
                        </td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->created_at->format('d-m-Y') }}</td>
                        <td>{{ $project->status ? 'Done' : 'In progress' }}</td>
                        <td>
                            {{-- stampo in pagina il tipo --}}
                            {{ $project->type ? $project->type->name : 'nessuna categoria' }}
                        </td>
                        <td>
                            @if ($project->technologies->count() > 0)
                                @foreach ($project->technologies as $technology)
                                    <span class="badge text-bg-info"> {{ $technology->name }}</span>
                                @endforeach
                            @else
                                <span>-</span>
                            @endif

                        </td>
                        <td class="d-flex align-items-center gap-2">
                            <a class="btn btn-primary" href="{{ route('admin.projects.show', $project) }}"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline" onsubmit="return confirm('Sicuro di voler eliminare?')"
                                action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
    <div class="my-5">
        {{ $projects->links() }}
    </div>
@endsection
