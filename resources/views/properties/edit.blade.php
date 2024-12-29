<x-app-layout>
    <style>
/* Styles for the edit property page */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 20px;
}

h2 {
    color: #333;
    margin-bottom: 20px;
}

form {
    background-color: white;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Ensure padding is included in width */
}

textarea {
    height: 100px; /* Adjust height for the description field */
}

button {
    background-color: #007bff; /* Bootstrap primary color */
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 15px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3; /* Darker shade on hover */
}

.error {
    color: red;
    margin-top: -10px;
    margin-bottom: 10px;
    font-size: 0.9em;
}


    </style>
    <h2>Edit Property</h2>

    <form action="{{ route('properties.update', $property->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $property->name }}" required>

        <label for="address">Address:</label>
        <input type="text" name="address" value="{{ $property->address }}" required>

        <label for="description">Description:</label>
        <textarea name="description">{{ $property->description }}</textarea>

        <button type="submit">Update Property</button>
    </form>
</x-app-layout>
