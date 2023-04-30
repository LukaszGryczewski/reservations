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

    <form method="post" action="{{ route('artist.delete', $artist->id) }}">
		@csrf
        @method('DELETE')
		<input type="hidden" name="method" value="DELETE">
		<button>Supprimer</button>
    </form>

    <nav><a href="{{ route('artist.index') }}">Retour à l'index</a></nav>
@endsection
