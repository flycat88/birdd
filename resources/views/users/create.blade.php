<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Add tenant</title>
</head>
<body>
    <h1>Add New tenant</h1>
    <form action="{{ route('tenants.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="house number">House no:</label>
        <input type="text" id="house number" name="house number" required>
        <br>
        <label for="rent">rent:</label>
        <input type="text" id="rent" name="rent" required>
        <br>
        <label for="balance">balance:</label>
        <input type="number" id="email" name="email" required>
        <br>
      
        <button type="submit">Add User</button>
    </form>
    <a href="{{ route('Users.index') }}">Back to Users List</a>
</body>
</html>
