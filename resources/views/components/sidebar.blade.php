<style>
    .sidebar {
        width: 250px;
        background-color: #343a40; /* Dark background for sidebar */
        color: white;
        padding: 20px;
        height: 100vh; /* Full height */
        position: fixed; /* Fixed sidebar */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
    }

    .sidebar h2 {
        margin-bottom: 20px;
        font-size: 1.5rem;
        font-weight: bold; /* Make the header bold */
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 10px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s; /* Smooth transition for background */
        margin-bottom: 5px; /* Space between links */
    }

    .sidebar a:hover {
        background-color: #495057; /* Darker gray on hover */
    }

    /* Optional active link styling */
    .sidebar a.active {
        background-color: #007bff; /* Blue for active link */
        color: white;
    }
</style>





<div class="sidebar">
    <h2 class="font-semibold text-xl">Dashboard</h2>
    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    <a href="{{ route('tenants.index') }}">{{ __('Tenants') }}</a>
    <a href="{{ route('units.index') }}">{{ __('Units') }}</a>
    <a href="{{ route('properties.index') }}">{{ __('Properties') }}</a>
</div>
