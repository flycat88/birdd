<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Add Bill for Tenant: {{ $tenant->name }}
    </h2>

    <div class="container">
        <!-- Bill Creation Form -->
        <form action="{{ route('invoices.storeBill', ['tenant_id' => $tenant->id]) }}" method="POST">
            @csrf

            <!-- Bill Description -->
            <div class="form-group">
                <label for="description">Bill Description:</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}" required>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Bill Amount -->
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount') }}" required>
                @error('amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Bill Date -->
            <div class="form-group">
                <label for="bill_date">Bill Date:</label>
                <input type="date" name="bill_date" id="bill_date" value="{{ old('bill_date') }}" required>
                @error('bill_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button for Adding Bill -->
            <button type="submit" class="btn btn-primary">Add Bill</button>
        </form>

        <!-- Back to Invoice Creation Button -->
        <a href="{{ route('invoices.create') }}" class="btn btn-secondary mt-3">Back to Invoice Creation</a>
    </div>

</x-app-layout>
