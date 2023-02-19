@extends('layouts.app')
@section('title','List des localitées')
@section('content')

    <h1>Listes des {{ $resource }}</h1>
    <ul>
        @foreach ($localities as $localitie )
            <li>{{ $localitie->postal_code }} {{  $localitie->locality }}</li>

        @endforeach
    </ul>
