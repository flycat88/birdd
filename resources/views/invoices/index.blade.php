<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Invoice List
    </h2>

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
