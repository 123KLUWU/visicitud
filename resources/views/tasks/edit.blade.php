@extends('layouts.base')

@section('title', 'Editar Tarea')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Editar Tarea</h2>
        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
            @csrf
            @method('PUT')
            @include('tasks._form')
            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection