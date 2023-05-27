@extends('layouts.main')

@section('title', 'Liste des événements Ticketmaster')

@section('content')
    <h1>Liste des TicketMaster</h1>

    <div class="row">
        @foreach ($theatres as $theatre)
            <div class="mb-4 col-md-4">
                <div class="shadow-sm card h-100">
                    <img class="card-img-top" src="{{ $theatre['images'][0]['url'] }}" alt="{{ $theatre['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $theatre['name'] }}</h5>
                        <p class="card-text">{{ $theatre['dates']['start']['localDate'] }}</p>
                        <p class="card-text">{{ $theatre['_embedded']['venues'][0]['name'] }}</p>
                        <a href="{{ $theatre['url'] }}" class="btn btn-primary">Acheter des billets</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">1 représentation</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    @if ($theatres->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $theatres->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo;</a>
                        </li>
                    @endif

                    @if ($theatres->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $theatres->nextPageUrl() }}" rel="next" aria-label="Next">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
