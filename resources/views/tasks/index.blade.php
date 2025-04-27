@extends('layouts.base')

@section('title', 'Mis Tareas')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Mis Tareas</h2>
        <a href="{{ route('tasks.create') }}" class="btn-primary">Nueva Tarea</a>
    </div>

    <div class="mb-4">
        <form action="{{ route('tasks.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" placeholder="Buscar tarea..." class="form-control mr-2" value="{{ request('search') }}">
            <select name="sort" class="form-control mr-2">
                <option value="">Ordenar por</option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Título</option>
                <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Prioridad</option>
                <option value="due_date" {{ request('sort') == 'due_date' ? 'selected' : '' }}>Fecha de Vencimiento</option>
            </select>
            <select name="filter" class="form-control mr-2">
                <option value="">Filtrar por</option>
                <option value="pending" {{ request('filter') == 'pending' ? 'selected' : '' }}>Pendientes</option>
                <option value="completed" {{ request('filter') == 'completed' ? 'selected' : '' }}>Completadas</option>
            </select>
            <button type="submit" class="btn-primary">Filtrar</button>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <ul class="task-list">
        @forelse ($tasks as $task)
            <li class="flex items-center justify-between py-2">
                <div>
                    <input type="checkbox" {{ $task->completed ? 'checked' : '' }} onclick="event.preventDefault(); document.getElementById('complete-task-{{ $task->id }}').submit();">
                    <a href="{{ route('tasks.show', $task->id) }}" class="ml-2 hover:text-blue-500">{{ $task->title }}</a>
                    @if ($task->due_date)
                        <span class="text-gray-500 text-sm ml-2">({{ $task->due_date }})</span>
                    @endif
                    <span class="text-gray-500 text-sm ml-2"> - {{ $task->priority }}</span>
                </div>
                <div>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                    <form id="complete-task-{{ $task->id }}" action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PATCH')
                    </form>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                    </form>
                </div>
            </li>
        @empty
            <li>No hay tareas.</li>
        @endforelse
    </ul>


@endsection