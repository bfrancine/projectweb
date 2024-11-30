@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <h1>Formulario de Registro</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <!-- Campos del formulario -->
        <input type="text" name="name" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Correo Electrónico" required>
        <input type="password" name="password" placeholder="contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
@endsection
