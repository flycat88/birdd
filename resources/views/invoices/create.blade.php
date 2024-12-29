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

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            text-decoration: none;
        }

        .btn-primary:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>

 <div class="container">
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <!-- Tenant Selection -->
            <div class="form-group">
                <label for="tenant_id">Tenant:</label>
                <select name="tenant_id" id="tenant_id" required onchange="updateInvoiceAmount()">
                    <option value="">-- Select Tenant --</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}"
                                data-rent="{{ $tenant->rent }}"
                                data-balance="{{ $tenant->balance }}"
                                {{ old('tenant_id', session('tenant_id')) == $tenant->id ? 'selected' : '' }}>
                            {{ $tenant->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Invoice Date -->
            <div class="form-group">
                <label for="invoice_date">Invoice Date:</label>
                <input type="date" name="invoice_date" value="{{ old('invoice_date') }}" required>
            </div>

            <!-- Due Date -->
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}" required>
            </div>

            <!-- Total Amount -->
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" step="0.01" name="total_amount" id="total_amount" value="{{ old('total_amount', session('total_amount', 0)) }}" readonly>
            </div>

            <!-- Paid Amount -->
            <div class="form-group">
                <label for="paid_amount">Paid Amount:</label>
                <input type="number" step="0.01" name="paid_amount" id="paid_amount" value="{{ old('paid_amount') }}" readonly>
            </div>

            <!-- Invoice Status -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" required>
                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <!-- Add Bill Button -->
            <div class="form-group">
                <a id="addBillLink" href="#" class="btn-primary disabled" disabled>
                    Add Bill
                </a>
            </div>

            <!-- Submit Button for Creating Invoice -->
            <button type="submit">Create Invoice</button>
        </form>
    </div>

    <script>
        function updateInvoiceAmount() {
            const tenantSelect = document.getElementById('tenant_id');
            const selectedOption = tenantSelect.options[tenantSelect.selectedIndex];
            const tenantId = selectedOption.value;

            // Get the rent value from the selected option's data-rent attribute
            const rentAmount = selectedOption.getAttribute('data-rent');

            // Set the total amount to the rent value
            const totalAmountInput = document.getElementById('total_amount');
            totalAmountInput.value = rentAmount;

            // Enable the "Add Bill" link
            const addBillLink = document.getElementById('addBillLink');
            if (tenantId) {
                addBillLink.href = `/invoices/${tenantId}/add-bill`;
                addBillLink.classList.remove('disabled');
                addBillLink.removeAttribute('disabled');
            } else {
                addBillLink.href = '#';
                addBillLink.classList.add('disabled');
                addBillLink.setAttribute('disabled', 'true');
            }
        }
    </script>
</x-app-layout>
