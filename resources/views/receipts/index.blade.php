<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Receipts List
    </h2>

    <div class="container">
        <a href="{{ route('receipts.create') }}">
            <button class="add-button">Add New Receipt</button>
        </a>

        @if ($receipts->isEmpty())
            <p>No receipts available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Receipt ID</th>
                        <th>Tenant Name</th>
                        <th>Invoice Number</th>
                        <th>Receipt Date</th>
                        <th>Amount Paid</th>
                        <th>Payment Method</th>
                        <th>Reference Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                        <tr>
                            <td>{{ $receipt->id }}</td>
                            <td>{{ $receipt->tenant->name ?? 'NA' }}</td>

                            <td>{{ $receipt->invoice->invoice_number ?? 'N/A' }}</td>
                            <td>{{ $receipt->receipt_date->format('Y-m-d') }}</td>
                            <td>{{ $receipt->amount_paid }}</td>
                            <td>{{ $receipt->payment_method }}</td>
                            <td>{{ $receipt->reference_number }}</td>
                            <td>
                                <a href="{{ route('receipts.edit', $receipt->id) }}" class="edit-button">Edit</a>
                                <form action="{{ route('receipts.destroy', $receipt->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this receipt?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
