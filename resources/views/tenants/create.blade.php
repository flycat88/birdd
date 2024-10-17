<!-- resources/views/tenants/create.blade.php -->
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
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h5>fill tenant details</h5>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenants.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>



        <label for="rent">Rent:</label>
        <input type="number" id="rent" name="rent" value="{{ old('rent') }}" required>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" value="{{ old('balance') }}" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>

        <label for="property_id">Select Property:</label>
        <select name="property_id" id="property_id" required>
            <option value="">-- Select Property --</option>
            @foreach ($properties as $property)
                <option value="{{ $property->id }}">{{ $property->name }}</option>
            @endforeach
        </select>

        <label for="unit_id">Select Unit:</label>
        <select name="unit_id" id="unit_id" required>
            <option value="">-- Select Unit --</option>
        </select>

        <button type="submit">Save</button>
    </form>
    <br>
    <a href="{{ route('tenants.index') }}">Back to Tenants List</a>

    <script>
        document.getElementById('property_id').addEventListener('change', function() {
            var propertyId = this.value;
            var unitSelect = document.getElementById('unit_id');

            // Clear previous units
            unitSelect.innerHTML = '<option value="">-- Select Unit --</option>';

            if (propertyId) {
                fetch(`/properties/${propertyId}/units`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length) {
                            data.forEach(unit => {
                                var option = document.createElement('option');
                                option.value = unit.id;
                                option.textContent = unit.name;
                                unitSelect.appendChild(option);
                            });
                        } else {
                            var option = document.createElement('option');
                            option.value = '';
                            option.textContent = 'No units available';
                            unitSelect.appendChild(option);
                        }
                    })
                    .catch(error => console.error('Error fetching units:', error));
            }
        });
    </script>
</body>
</html>
