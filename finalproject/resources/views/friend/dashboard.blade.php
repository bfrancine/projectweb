@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, Friend!</h1>
        <nav>
            <ul>
                <li><a href="{{ route('friend.list_trees', ['friend_id' => $friend_id]) }}">List trees</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </nav>
    </div>
@endsection
