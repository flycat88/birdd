<x-app-layout>
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Add Bill for Tenant: {{ $tenant->name }}
  </h2>

  <div class="container">
      <form action="{{ route('invoices.storeBill', ['tenant_id' => $tenant->id]) }}" method="POST">
          @csrf

          <div class="form-group">
              <label for="description">Bill Description:</label>
              <input type="text" name="description" id="description" value="{{ old('description') }}" required>
          </div>

          <div class="form-group">
              <label for="amount">Amount:</label>
              <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount') }}" required>
          </div>

          <button type="submit" class="btn btn-primary">Add Bill</button>
      </form>

      <a href="{{ route('invoices.create') }}" class="btn btn-secondary mt-3">Back to Invoice Creation</a>
  </div>
</x-app-layout>
