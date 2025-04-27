@extends('layouts.base')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Iniciar Sesión</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Error!</strong>
                <span class="block sm:inline">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </span>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="btn-primary">Iniciar Sesión</button>
                <a href="/register" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    ¿No tienes una cuenta? Regístrate
                </a>
            </div>
        </form>
    </div>
@endsection