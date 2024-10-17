<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            background-color: #f8fafc; /* Light gray background */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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
            overflow-y: auto; /* Scroll if content overflows */
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
        .content {
            margin-left: 250px; /* Space for sidebar */
            padding: 20px;
            flex: 1;
            min-height: 100vh; /* Full height */
            overflow-y: auto; /* Scrollable content */
        }
        header {
            margin-top: 20px; /* Add space above the header */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 layout">
        @include('layouts.sidebar')

        <div class="content">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }} <!-- This will display the content passed to the component -->
            </main>
        </div>
    </div>
</body>

</html>
