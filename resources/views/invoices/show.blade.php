@section('content')
<div class="container">
    <h1 class="text-center mb-4">Invoice Details</h1>

    <div class="card shadow">
        <div class="card-header">
            <h2>Invoice #{{ $invoice->id }}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tenant Name:</strong>
                    <p>{{ $invoice->tenant->name }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong>
                    <p class="{{ $invoice->status === 'paid' ? 'text-success' : ($invoice->status === 'canceled' ? 'text-danger' : 'text-warning') }}">
                        {{ ucfirst($invoice->status) }}
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Invoice Date:</strong>
                    <p>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F j, Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Due Date:</strong>
                    <p>{{ \Carbon\Carbon::parse($invoice->due_date)->format('F j, Y') }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Total Amount:</strong>
                    <p>${{ number_format($invoice->total_amount, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Balance:</strong>
                    <p>${{ number_format($invoice->tenant->balance ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to Invoices</a>
        </div>
    </div>
</div>
@endsection
