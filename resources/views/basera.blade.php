<div class="mb-4">
    <label for="priority" class="block text-gray-700 text-sm font-bold mb-2">Frecuencia</label>
    <select name="priority" id="priority" class="form-control" required>
        @foreach($frequencies as $unidad)
            <option value="{{ $unidad->id }}">
                {{ $unidad->name }}
            </option>
        @endforeach
    </select>
    @error('priority')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>