@extends('layouts.app')

@section('content')
<nav>
    <ul>
        <li><a href="{{ route('friend.trees') }}">List Trees</a></li>
        <li><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Logout</button></form></li>
    </ul>
</nav>
@endsection
