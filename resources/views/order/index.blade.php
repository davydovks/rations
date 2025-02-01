<x-layout>
    <div class="grid">
        <h1 class="text-3xl mb-5">Список заказов</h1>
        <table>
            <thead class="border-b-2 border-solid border-black text-left">
                <th>ID</th>
                <th>Клиент</th>
                <th>Телефон</th>
                <th>Рацион</th>
                <th>Начальная дата</th>
                <th>Конечная дата</th>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            <a href="/order/{{ $order->id }}" class="flex hover:text-blue-600 hover:underline">{{ $order->client_name }}</a>
                        </td>
                        <td>{{ $order->client_phone }}</td>
                        <td>{{ $order->tariff->ration_name }}</td>
                        <td>{{ $order->first_date }}</td>
                        <td>{{ $order->last_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>