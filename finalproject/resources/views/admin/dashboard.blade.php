@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, Admin!</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.species') }}">Species</a></li>
                <li><a href="{{ route('admin.friends') }}">Friends</a></li>
                <li><a href="{{ route('admin.tree') }}">Tree</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </nav>
    </div>
@endsection
