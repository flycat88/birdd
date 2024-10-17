 <!-- Sidebar Navigation -->
 <div class="sidebar">
    <h2 class="font-semibold text-xl"></h2>
    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    <a href="{{ route('tenants.index') }}">{{ __('Tenants') }}</a>
    <a href="{{ route('units.index') }}">{{ __('Units') }}</a>
    <a href="{{ route('properties.index') }}">{{ __('properties') }}</a>
    <a href="{{ route('invoices.index') }}">{{ __('invoices') }}</a>
    <a href="{{ route('balances.index') }}">{{ __('balances') }}</a>

    <a href="{{ route('receipts.index') }}">{{ __('receipts') }}</a>
    {{-- <a href="{{ route('balances.index') }}">{{ __('Properties') }}</a> --}}
</div>
<style>
    body {
        background-color: #f8fafc; /* Light gray background */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .layout {
        display: flex;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40; /* Dark background for sidebar */
        color: white;
        padding: 20px;
        height: 100vh; /* Full height */
        position: fixed; /* Fixed sidebar */
    }
    .content {
        margin-left: 250px; /* Space for sidebar */
        padding: 20px;
        background-color: white;
        flex: 1;
        min-height: 100vh; /* Full height */
        overflow-y: auto; /* Scrollable content */
    }
    .sidebar h2 {
        margin-bottom: 20px;
        font-size: 1.5rem;
    }
    .sidebar a {
        display: block;
        color: white;
        padding: 10px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin-bottom: 5px; /* Space between links */
    }
    .sidebar a:hover {
        background-color: #495057; /* Darker gray on hover */
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


