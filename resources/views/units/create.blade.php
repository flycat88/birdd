
    <head>
        <style>
            body {
                background-color: #f8fafc; /* Light gray background */
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
            }
            input[type="text"], select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                transition: border-color 0.3s;
            }
            input[type="text"]:focus, select:focus {
                border-color: #007bff; /* Blue border on focus */
                outline: none;
            }
            button {
                width: 100%;
                padding: 10px;
                background-color: #007bff; /* Bootstrap primary color */
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            button:hover {
                background-color: #0056b3; /* Darker blue on hover */
            }
            .alert {
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 4px;
                color: #856404; /* Bootstrap alert color */
                background-color: #d4edda; /* Light green background */
                border: 1px solid #c3e6cb; /* Light green border */
            }
            .error {
                background-color: #f8d7da; /* Light red background */
                border: 1px solid #f5c6cb; /* Light red border */
                color: #721c24; /* Dark red text */
                padding: 10px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <div class="container">
        <h1>Add Unit</h1>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('units.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Unit Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="property_id">Property</label>
                <select name="property_id" id="property_id" required>
                    <option value="">Select a property</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                            {{ $property->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Add Unit</button>
            <a href="{{ route('units.index') }}">Back to units List</a>
        </form>
        
    </div>
