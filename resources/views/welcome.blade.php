@extends('layouts.base')

@section('title', 'Bienvenido')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4">¡Bienvenido a Vicissitude To-Do!</h1>
        <p class="text-lg mb-8">La mejor manera de organizar tus tareas diarias.</p>
        <div class="flex justify-center">
            <a href="/public/login" class="btn-primary mr-4">Iniciar Sesión</a>
            <a href="/public/register" class="btn-primary">Registrarse</a>
        </div>
    </div>
@endsection