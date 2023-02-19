@extends('layouts.main')
@section('title','Les differents role')
@section('content')

<h1>{{ $resource }}</h1>
<ul>
@foreach ($roles as $role )
    <li>{{ $role->name }}  {{ $role->display_name }}</li>
@endforeach
</ul>
