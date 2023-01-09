@extends('layouts.main')

@section('title', 'Fiche d\'un artiste')

@section('content')
    <h1>{{ $artist->firstname }} {{ $artist->lastname }}</h1>

    <h2>List des types</h2>
    <ul>
        @foreach($artist->types as $type)
            <li>{{$type->type}}</li>
        @endforeach
    </ul>

    <div><a href="{{ route('artist.edit',$artist->id) }}">Modifer</a></a></div>
    
    <nav><a href="{{ route('artist.index') }}">Retour à l'index</a></nav>
@endsection
