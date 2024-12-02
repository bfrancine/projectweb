@extends('layouts.app')

@section('content')
    <h1>Friends</h1>
    <ul>
        @foreach ($friends as $friend)
            <li>{{ $friend->first_name }} {{ $friend->last_name }}</li>
        @endforeach
    </ul>
@endsection
