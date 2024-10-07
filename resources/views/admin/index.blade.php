@extends('layouts.app')

@section('content')
    <h1 class="text-center">Ciao {{ Auth::user()->name }} hai {{ $projectCount }} progetti attualmente disponibili!</h1>
@endsection
