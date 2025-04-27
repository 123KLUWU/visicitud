@extends('layouts.base')

@section('title', 'Nueva Tarea')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Nueva Tarea</h2>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            @include('tasks._form')
            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection