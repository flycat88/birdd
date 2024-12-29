<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Invoice List
    </h2>

    <style>
        /* Add your styling here */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn-edit, .btn-delete {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            margin-right: 5px;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>

    <div class="container">
        <a href="{{ route('invoices.create') }}">




            <button class="add-button">Add New Invoice</button>
        </a>

        @if ($invoices->isEmpty())
            <p>No invoices available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Tenant Name</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Status</th>
                        <th>Bill Amount</th> <!-- New column for Bill Amount -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->tenant->name }}</td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ $invoice->due_date }}</td>
                            <td>{{ $invoice->total_amount }}</td>
                            <td>{{ $invoice->paid_amount }}</td>
                            <td>{{ ucfirst($invoice->status) }}</td>
                            <td>{{ number_format($invoice->total_bill_amount, 2) }}</td> <!-- Displaying Bill Amount -->
                            <td>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="edit-button">Edit</a>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-app-layout>
