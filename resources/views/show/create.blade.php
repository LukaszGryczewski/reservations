@extends('layouts.main')

@section('title', 'Ajouter un spectacle')

@section('content')
    <h2>Ajouter un show</h2>

    <form action="{{ route('show.store') }}" method="post">
        @csrf
        <div>
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug"
                   @if(old('slug'))
                   value="{{ old('slug') }}"
                   @endif
                   class="@error('slug') is-invalid @enderror">

            @error('slug')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="title">Titre</label>
            <input type="text" id="title" name="title"
                   @if(old('title'))
                   value="{{ old('title') }}"
                   @endif
                   class="@error('title') is-invalid @enderror">

            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" class="@error('description') is-invalid @enderror">{{ old('description') }}</textarea>

            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id">
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->designation }}</option>
                @endforeach
            </select>

            @error('location_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="bookable">Bookable</label>
            <input type="text" id="bookable" name="bookable"
                   @if(old('bookable'))
                   value="{{ old('bookable') }}"
                   @endif
                   class="@error('bookable') is-invalid @enderror">

            @error('bookable')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="price">Prix</label>
            <input type="text" id="price" name="price"
                   @if(old('price'))
                   value="{{ old('price') }}"
                   @endif
                   class="@error('price') is-invalid @enderror">

            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Champ pour les artistes -->
        <div>
            <label for="artists">Artistes</label>
            <select name="artists[]" id="artists" multiple>
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->firstname }} {{ $artist->lastname }}</option>
                @endforeach
            </select>

            @error('artists')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Champ pour les représentations -->
        <div>
            <label for="representations">Représentations</label>
            <!-- Champs pour les dates et lieux des représentations -->
            <div id="representations-container" data-representation-count="1">
                <div class="representation">
                    <input type="datetime-local" name="representations[0][when]" required>
                    <select name="representations[0][location_id]">
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->designation }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Bouton pour ajouter une nouvelle représentation -->
            <button type="button" id="add-representation">Ajouter une représentation</button>

            @error('representations')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button>Ajouter</button>
        <a href="{{ route('show.index') }}">Annuler</a>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h2>Liste des erreurs de validation</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <nav><a href="{{ route('show.index') }}">Retour à l'index</a></nav>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addRepresentationButton = document.getElementById('add-representation');
            var representationsContainer = document.getElementById('representations-container');
            var representationCount = 1;

            addRepresentationButton.addEventListener('click', function(e) {
                e.preventDefault();

                var representationDiv = document.createElement('div');
                representationDiv.classList.add('representation');

                var datetimeInput = document.createElement('input');
                datetimeInput.setAttribute('type', 'datetime-local');
                datetimeInput.setAttribute('name', 'representations[' + representationCount + '][when]');

                var locationSelect = document.createElement('select');
                locationSelect.setAttribute('name', 'representations[' + representationCount + '][location_id]');

                @foreach ($locations as $location)
                    var locationOption = document.createElement('option');
                    locationOption.setAttribute('value', '{{ $location->id }}');
                    locationOption.textContent = '{{ $location->designation }}';
                    locationSelect.appendChild(locationOption);
                @endforeach

                representationDiv.appendChild(datetimeInput);
                representationDiv.appendChild(locationSelect);

                representationsContainer.appendChild(representationDiv);
                representationCount++;
            });
        });
    </script>
@endpush
