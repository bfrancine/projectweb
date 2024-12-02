@extends('layouts.app')

@section('content')
    <h1>Trees</h1>
    <ul>
        @foreach ($trees as $tree)
            <li>{{ $tree->species->commercial_name }} - {{ $tree->location }}</li>
        @endforeach
    </ul>
@endsection
