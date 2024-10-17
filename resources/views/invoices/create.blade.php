<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Invoice
    </h2>

    <style>
        body {
            background-color: #f8fafc;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input:focus, select:focus {
            border-color: #007bff;
            background-color: #fff;
            outline: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 10px 0;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>

    <div class="container">
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="tenant_id">Tenant:</label>
                <select name="tenant_id" required>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="form-group">
                <label for="invoice_number">Invoice Number:</label>
                <input type="text" name="invoice_number" required>
            </div> --}}

            <div class="form-group">
                <label for="invoice_date">Invoice Date:</label>
                <input type="date" name="invoice_date" required>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" required>
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" step="0.01" name="total_amount" required>
            </div>

            <div class="form-group">
                <label for="paid_amount">Paid Amount (optional):</label>
                <input type="number" step="0.01" name="paid_amount">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" required>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>

            <button type="submit">Create Invoice</button>
        </form>
    </div>
</x-app-layout>
