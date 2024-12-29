<x-app-layout>
    <style>
        body {
            background-color: #f8fafc; /* Light gray background */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px;
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

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5; /* Light gray for row hover */
        }

        /* Button Styling for Delete */
        .delete-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-button:hover {
            background-color: #c0392b;
        }

        /* Button Styling for Edit */
        .edit-button {
            color: #3498db;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 14px;
        }
        .edit-button:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <a href="{{ route('units.create') }}">
            <button class="add-button">Add New Unit</button>
        </a>
        <h1>Units</h1>

        @if ($units->isEmpty())
            <p>No units available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Property Name</th>
                        <th>Occupancy Status</th>
                        <th>Tenant</th>
                        <th>Actions</th> <!-- Added actions column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->property->name  }}</td>

                            <!-- Display occupancy status with tenant details if occupied -->
                            <td>
                                @if($unit->tenant_id) <!-- If tenant_id is set, it's occupied -->
                                Occupied
                            @else
                                Vacant
                            @endif
                            </td>

                            <td>
                                <!-- Display tenant name if available -->
                                @if ($unit->tenant)
                                    <span>{{ $unit->tenant->name }}</span>
                                @else
                                    <span>-</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('units.edit', $unit->id) }}" class="edit-button">Edit</a>
                                
                                <!-- Delete Form -->
                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this unit?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
