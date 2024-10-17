<x-app-layout>
    <head>
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
            }
            .sidebar a:hover {
                background-color: #495057; /* Darker gray on hover */
            }
            .content {
                margin-left: 250px; /* Space for sidebar */
                padding: 20px;
                background-color: white;
                flex: 1;
                height: 100vh; /* Full height */
                overflow-y: auto; /* Scrollable content */
            }
            .content h2 {
                margin-bottom: 20px;
            }
            .content .dashboard-message {
                font-size: 1.2rem;
                color: #4a5568; /* Gray-700 */
                text-align: center;
            }
            /* Responsive adjustments */
            @media (max-width: 768px) {
                .sidebar {
                    position: relative;
                    width: 100%; /* Full width on small screens */
                    height: auto; /* Auto height */
                }
                .content {
                    margin-left: 0; /* No margin on small screens */
                }
            }
        </style>
    </head>

    <div class="layout">
        <!-- Sidebar Navigation -->
        {{-- <div class="sidebar">
            <h2 class="font-semibold text-xl"></h2>
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            <a href="{{ route('tenants.index') }}">{{ __('Tenants') }}</a>
            <a href="{{ route('units.index') }}">{{ __('Units') }}</a>
            <a href="{{ route('properties.index') }}">{{ __('Properties') }}</a>
        </div> --}}

        <!-- Main Content -->
        <div class="content">
            <div class="dashboard-header text-center mb-4">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('') }}
                </h2>
            </div>
            <div class="dashboard-container">
                <div class="p-6 dashboard-message">
                    {{ __("") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
