<x-app-layout>
    <style>
        body {
            background-color: #f8fafc; /* Light gray background */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 7SS00px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .add-button {
            background-color: #007bff; /* Primary color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px; /* Space below button */
        }
        .add-button:hover {
            background-color: #0056b3; /* Darker blue */
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Light gray for header */
        }
        tr:hover {
            background-color: #f5f5f5; /* Light gray for row hover */
        }
    </style>

    <div class="container">
        <a href="{{ route('properties.create') }}">
            <button class="add-button">Add New Property</button>
        </a>
        <h1>Properties</h1>

        @if ($properties->isEmpty())
            <p>No properties available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->location }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
