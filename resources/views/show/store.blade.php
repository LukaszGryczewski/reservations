@extends('layouts.main')

@section('title', 'Modifier un show')

@section('content')
    <h2>Modifier un spectacle</h2>

    <form action="{{ route('show.create') }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug"
            @if(old('slug'))
                value="{{ old('slug') }}"
            @else
                value="{{ $show->slug }}"
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
            @else
                value="{{ $show->title }}"
            @endif
	           class="@error('title') is-invalid @enderror">

	        @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <input type="text" id="description" name="description"
            @if(old('description'))
                value="{{ old('description') }}"
            @else
                value="{{ $show->description }}"
            @endif
	           class="@error('description') is-invalid @enderror">

	        @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="location_id">Location</label>
            <input type="text" id="location_id" name="location_id"
            @if(old('location_id'))
                value="{{ old('location_id') }}"
            @else
                value="{{ $show->location_id }}"
            @endif
	           class="@error('location_id') is-invalid @enderror">

	        @error('location_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="bookable">Bookable</label>
            <input type="text" id="bookable" name="bookable"
            @if(old('bookable'))
                value="{{ old('bookable') }}"
            @else
                value="{{ $show->bookable }}"
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
            @else
                value="{{ $show->price }}"
            @endif
	           class="@error('price') is-invalid @enderror">

	        @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button>Modifier</button>
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
