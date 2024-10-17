<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tenant Balances</h2>


    <table>
        <thead>
            <tr>
                <th>Tenant Name</th>
                <th>Phone Number</th>
                <th>House Number</th>
                <th>Rent</th>
                <th>Carry Forward Balance</th>
                <th>Total Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($balances as $balance)
                <tr>
                    <td>{{ $balance['tenant']->name }}</td>
                    <td>{{ $balance['tenant']->phone_number }}</td>
                    <td>{{ $balance['house_number'] }}</td>
                    <td>{{ $balance['rent'] }}</td>
                    <td>{{ $balance['carry_forward'] }}</td>
                    <td>{{ $balance['balance'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
