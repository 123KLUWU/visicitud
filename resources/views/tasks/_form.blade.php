<div class="mb-4">
    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Título</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required autofocus>
    @error('title')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="priority" class="block text-gray-700 text-sm font-bold mb-2">Prioridad</label>
    <select name="priority_id" id="priority" class="form-control" required>
        @foreach($priorities as $unidad)
            <option value="{{ $unidad->id }}">
                {{ $unidad->name }}
            </option>
        @endforeach
    </select>
    @error('priority')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Vencimiento</label>
    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date ?? '') }}">
    @error('due_date')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>