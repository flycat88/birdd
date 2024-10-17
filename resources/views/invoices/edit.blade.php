<x-app-layout>
    <style>
        body {
            background-color: #f8fafc; /* Light gray background */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        select, input[type="date"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>

    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Invoice
        </h2>

        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="tenant_id">Tenant:</label>
            <select name="tenant_id" required>
                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}" {{ $tenant->id == $invoice->tenant_id ? 'selected' : '' }}>{{ $tenant->name }}</option>
                @endforeach
            </select>

            <label for="invoice_date">Invoice Date:</label>
            <input type="date" name="invoice_date" value="{{ $invoice->invoice_date }}" required>

            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" value="{{ $invoice->due_date }}" required>

            <label for="total_amount">Total Amount:</label>
            <input type="number" step="0.01" name="total_amount" value="{{ $invoice->total_amount }}" required>

            <label for="paid_amount">Paid Amount:</label>
            <input type="number" step="0.01" name="paid_amount" value="{{ $invoice->paid_amount }}">

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="canceled" {{ $invoice->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>

            <button type="submit">Update Invoice</button>
        </form>
    </div>
</x-app-layout>
