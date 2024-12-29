<!-- Sidebar Navigation -->
<div class="sidebar">
    <h2 class="font-semibold text-xl">Menu</h2>

    <a href="{{ route('tenants.index') }}">
        <i class="fas fa-users"></i> {{ __('Tenants') }}
    </a>
    <a href="{{ route('units.index') }}">
        <i class="fas fa-building"></i> {{ __('Units') }}
    </a>
    <a href="{{ route('properties.index') }}">
        <i class="fas fa-home"></i> {{ __('Properties') }}
    </a>
    <a href="{{ route('invoices.index') }}">
        <i class="fas fa-file-invoice-dollar"></i> {{ __('Invoices') }}
    </a>
    <a href="{{ route('balances.index') }}">
        <i class="fas fa-balance-scale"></i> {{ __('Balances') }}
    </a>
    <a href="{{ route('receipts.index') }}">
        <i class="fas fa-receipt"></i> {{ __('Receipts') }}
    </a>
</div>

<!-- Add Font Awesome CSS for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .sidebar a {
        display: flex;
        align-items: center;
        color: white;
        padding: 10px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin-bottom: 5px;
    }

    .sidebar a i {
        margin-right: 10px; /* Space between icon and text */
        font-size: 16px; /* Icon size */
    }

    .sidebar a:hover {
        background-color: #495057;
    }
</style>
