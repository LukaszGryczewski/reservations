@extends('layouts.main')

@section('title', 'Liste des événements')

@section('content')
    <h1>Liste des spectacles</h1>

    <h2>Spectacles</h2>
    @if(isset($shows) && count($shows) > 0)
        <div class="row">
            @foreach($shows as $show)
                <!-- Affiche les détails du spectacle -->
            @endforeach
        </div>
    @else
        <p>Aucun spectacle trouvé.</p>
    @endif

    <h2>Concerts</h2>
    @if(isset($concerts) && count($concerts) > 0)
        <div class="row">
            @foreach($concerts as $concert)
                <!-- Affiche les détails du concert -->
            @endforeach
        </div>
    @else
        <p>Aucun concert trouvé.</p>
    @endif

    <h2>Pièces de théâtre</h2>
    @if(isset($theatrePlays) && count($theatrePlays) > 0)
        <div class="row">
            @foreach($theatrePlays as $theatrePlay)
                <!-- Affiche les détails de la pièce de théâtre -->
            @endforeach
        </div>
    @else
        <p>Aucune pièce de théâtre trouvée.</p>
    @endif
@endsection
