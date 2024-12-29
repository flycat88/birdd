<x-app-layout>
    <h2>Edit Unit</h2>

    <form action="{{ route('units.update', $unit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $unit->name }}" required>

        <label for="description">Description:</label>
        <textarea name="description">{{ $unit->description }}</textarea>

        <button type="submit">Update Unit</button>
    </form>
</x-app-layout>
