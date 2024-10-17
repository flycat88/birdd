<x-app-layout>
    <style>
        /* Styling for the main content area */
        .content-area {
            padding: 20px; /* Padding around the content */
            background-color: #f9f9f9; /* Light background color */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        /* Basic form styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Space between form elements */
        }

        label {
            font-weight: bold;
            margin-bottom: 5px; /* Space below the label */
        }

        input, select {
            padding: 10px;
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size for input */
        }

        input:focus, select:focus {
            border-color: #007BFF; /* Blue border on focus */
            outline: none; /* Remove outline */
        }

        button {
            background-color: #007BFF; /* Blue background */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer; /* Change cursor to pointer */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        h2 {
            margin-bottom: 20px; /* Space below the heading */
        }
    </style>

    <div class="content-area">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Receipt
        </h2>

        <form action="{{ route('receipts.store') }}" method="POST">
            @csrf

            <label for="invoice_id">Invoice:</label>
            <select name="invoice_id" required>
                @foreach($invoices as $invoice)
                    <option value="{{ $invoice->id }}">Invoice #{{ $invoice->invoice_number }}</option>
                @endforeach
            </select>

            <label for="receipt_date">Receipt Date:</label>
            <input type="date" name="receipt_date" required>

            <label for="amount_paid">Amount Paid:</label>
            <input type="number" step="0.01" name="amount_paid" required>

            <label for="payment_method">Payment Method:</label>
            <input type="text" name="payment_method" required>

            <label for="reference_number">Reference Number (optional):</label>
            <input type="text" name="reference_number">

            <button type="submit">Add Receipt</button>
        </form>
    </div>
</x-app-layout>
