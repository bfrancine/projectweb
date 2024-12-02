@extends('layouts.app')

@section('content')
<nav>
    <ul>
        <li><a href="{{ route('admin.species') }}">Species</a></li>
        <li><a href="{{ route('admin.friends') }}">Friends</a></li>
        <li><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Logout</button></form></li>
    </ul>
</nav>
@endsection
