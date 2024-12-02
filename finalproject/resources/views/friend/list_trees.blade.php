@extends('layouts.app')

@section('content')
    <header>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <nav class="main-nav">
            <ul>
                <li><a href="{{ route('friend.listTrees', ['friend_id' => $friend_id]) }}">List trees</a></li>
                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div>
        <h2>Your Trees</h2>
        <ul>
            @foreach($trees as $tree)
                <li>{{ $tree->name }} - {{ $tree->location }}</li>
            @endforeach
        </ul>
    </div>
@endsection
