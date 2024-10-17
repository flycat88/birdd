<!-- resources/views/tenants/show.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tenant Details</title>
</head>
<body>
    <h1>Tenant Details</h1>
    <p><strong>Name:</strong> {{ $tenant->name }}</p>
    <p><strong>house_no:</strong> {{ $tenant->house_no }}</p>
    <p><strong>rent:</strong> {{ $tenant->rent }}</p>
    <p><strong>balance:</strong> {{ $tenant->balance }}</p>
    <p><strong>phone number:</strong> {{ $tenant->phone_number }}</p>
    <a href="{{ route('tenants.index') }}">Back to Tenants List</a>
</body>
</html>
