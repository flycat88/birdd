<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

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
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px; /* Add space below the button */
        }
        .add-button:hover {
            background-color: #0056b3; /* Darker blue */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        <a href="{{ route('tenants.create') }}">
            <button class="add-button">Add New Tenant</button>
        </a>

        <h6 class="font-semibold mb-4">Tenant List</h6>

        @if ($tenants->isEmpty())
            <p>No tenants available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>House Number</th>
                        <th>Rent</th>
                        <th>Balance</th>
                        <th>Phone Number</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->unit->name ?? 'N/A' }}</td>
                            <td>{{ $tenant->rent }}</td>
                            <td>{{ $tenant->balance }}</td>
                            <td>{{ $tenant->phone_number }}</td>
                            <td>
                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="edit-button">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this tenant?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
