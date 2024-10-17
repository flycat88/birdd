<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Tenant') }}
    </h2>
</x-slot>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus {
        border-color: #007BFF;
        outline: none;
    }

    .add-button {
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        width: 100%;
    }

    .add-button:hover {
        background-color: #0056b3;
    }

    .add-button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
</style>

<div class="container">
    <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $tenant->name }}" required>


        <label for="rent">Rent:</label>
        <input type="number" id="rent" name="rent" value="{{ $tenant->rent }}" required>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" value="{{ $tenant->balance }}">

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ $tenant->phone_number }}" required>

        <label for="unit_id">Unit:</label>
        <select name="unit_id" id="unit_id" required>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ $tenant->unit_id == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="add-button">Update Tenant</button>
    </form>
</div>
