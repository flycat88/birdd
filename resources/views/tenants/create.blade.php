<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tenant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }
        input[type="number"], input[type="text"] {
            margin-bottom: 20px;
        }
        button {
            background-color: #0f39e2;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #375bf7;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
        }
    </style>
</head>
<body>
    <h5>Fill Tenant Details</h5>

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

    <form action="{{ route('tenants.store') }}" method="POST" id="tenantForm">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter tenant's full name">

        <label for="rent">Rent:</label>
        <input type="number" id="rent" name="rent" value="{{ old('rent') }}" required placeholder="Enter rent amount">

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" value="{{ old('balance') }}" required placeholder="Enter current balance">

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Enter phone number">

        <label for="property_id">Select Property:</label>
        <select name="property_id" id="property_id" required>
            <option value="">-- Select Property --</option>
            @foreach ($properties as $property)
                <option value="{{ $property->id }}">{{ $property->name }}</option>
            @endforeach
        </select>

        <label for="unit_id">Select Unit:</label>
        <select name="unit_id" id="unit_id" required>
             <option value="">Select a unit</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }} ({{ $unit->property->name }})
                </option>
            @endforeach
        </select>

        <button type="submit">Save</button>
    </form>
    <br>
    <a href="{{ route('tenants.index') }}">Back to Tenants List</a>

    <script>
    document.getElementById('property_id').addEventListener('change', function() {
    var propertyId = this.value;  // Get the selected property ID
    console.log('Selected Property ID:', propertyId); 
    if (propertyId) {
        fetch(`/properties/${propertyId}/vacant-units`)  // Adjust to correct route
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch units');
                }
                return response.json();  // Parse JSON response
            })
            .then(data => {
                console.log('Vacant Units:', data);  // Log the data for debugging
                // Handle the units...
            })
            .catch(error => {
                console.error('Error fetching units:', error);
            });


    var unitSelect = document.getElementById('unit_id');  // The dropdown for units
    var submitButton = document.querySelector('button[type="submit"]');  // The submit button
    var errorMessage = document.querySelector('.error');  // Error message element

    // Clear previous units
    unitSelect.innerHTML = '<option value="">-- Select Unit --</option>';

    // Disable submit button while fetching units
    submitButton.disabled = true;

    // If a property is selected, fetch its vacant units
    if (propertyId) {
        fetch(`/properties/${propertyId}/vacant-units`)  // Adjust to correct route
            .then(response => {
                // Check for successful response
                if (!response.ok) {
                    throw new Error('Failed to fetch units');
                }
                return response.json();  // Parse JSON response
            })
            .then(data => {
                console.log('Vacant Units:', data);  // Log the data for debugging

                // Clear any previous error message
                errorMessage?.remove();

                // Check if there are vacant units
                if (data.length > 0) {
                    data.forEach(unit => {
                        var option = document.createElement('option');
                        option.value = unit.id;
                        option.textContent = `${unit.name} (${unit.property.name})`;  // Show unit name and property
                        unitSelect.appendChild(option);  // Append the unit to the dropdown
                    });
                } else {
                    // If no units, show a message in the dropdown
                    var option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'No units available';
                    unitSelect.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error fetching units:', error);
                var errorDiv = document.createElement('div');
                errorDiv.classList.add('error');
                errorDiv.textContent = 'Failed to load units. Please try again later.';
                document.body.insertBefore(errorDiv, document.getElementById('tenantForm'));
            })
            .finally(() => {
                // Re-enable the submit button after request completes
                submitButton.disabled = false;
            });
    } else {
        // If no property is selected, reset the unit dropdown and show a message
        var option = document.createElement('option');
        option.value = '';
        option.textContent = '-- Select a property first --';
        unitSelect.appendChild(option);
    }
});


    </script>
</body>
</html>
