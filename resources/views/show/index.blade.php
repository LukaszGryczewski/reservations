@extends('layouts.main')

@section('title', 'Liste des spectacles')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <div class="row">
        @foreach($shows as $show)
            <div class="mb-4 col-md-4">
                <div class="card h-100">
                    @if($show->poster_url)
                        <img src="{{ $show->poster_url }}" alt="{{ $show->title }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('show.show', $show->id) }}">{{ $show->title }}</a></h5>
                        @if($show->bookable)
                            <h6 class="mb-2 card-subtitle text-muted">{{ $show->price }} €</h6>
                        @endif
                        <p class="card-text">{{ $show->description }}</p>
                    </div>
                    <div class="card-footer">
                        @if($show->representations->count()==1)
                            <small class="text-muted">1 représentation</small>
                        @elseif($show->representations->count()>1)
                            <small class="text-muted">{{ $show->representations->count() }} représentations</small>
                        @else
                            <small class="text-muted">aucune représentation</small>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
