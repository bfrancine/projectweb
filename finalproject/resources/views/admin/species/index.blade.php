@extends('layouts.app')

@section('content')
    <h1>Species</h1>
    <ul>
        @foreach ($species as $specie)
            <li>{{ $specie->commercial_name }} ({{ $specie->scientific_name }})</li>
        @endforeach
    </ul>
@endsection
