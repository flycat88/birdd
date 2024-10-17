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
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
        Edit Receipt
    </h2>

    <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg">
        <form action="{{ route('receipts.update', $receipt->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- This method is important for updating -->

            <div class="mb-4">
                <label for="amount_paid" class="block text-gray-700 font-bold">Amount Paid:</label>
                <input type="text" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $receipt->amount_paid) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('amount_paid')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block text-gray-700 font-bold">Payment Method:</label>
                <input type="text" name="payment_method" id="payment_method" value="{{ old('payment_method', $receipt->payment_method) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('payment_method')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="reference_number" class="block text-gray-700 font-bold">Reference Number:</label>
                <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', $receipt->reference_number) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('reference_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Receipt
                </button>
            </div>
        </form>

        <a href="{{ route('receipts.index') }}" class="inline-block mt-4 text-blue-500 hover:underline">Back to Receipts</a>
    </div>
</x-app-layout>
