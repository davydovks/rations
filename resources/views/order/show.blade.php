<x-layout>
    <div class="grid">
        <h1 class="text-3xl mb-5">Просмотр заказа</h1>
        <p><span class="font-bold inline-block w-40">ID</span>{{ $order->id }}</p>
        <p><span class="font-bold inline-block w-40">Клиент</span>{{ $order->client_name }}</p>
        <p><span class="font-bold inline-block w-40">Телефон</span>{{ $order->client_phone }}</p>
        <p><span class="font-bold inline-block w-40">Рацион</span>{{ $order->tariff->ration_name }}</p>
        <p><span class="font-bold inline-block w-40">Расписание</span>{{ $order->schedule_type }}</p>
        <p><span class="font-bold inline-block w-40">Дата создания</span>{{ $order->created_at }}</p>
        <p><span class="font-bold inline-block w-40">Начальная дата</span>{{ $order->first_date }}</p>
        <p><span class="font-bold inline-block w-40">Конечная дата</span>{{ $order->last_date }}</p>
        <h2 class="text-2xl my-5">Рационы</h2>
        <table>
            <thead class="border-b-2 border-solid border-black text-left">
                <th>№</th>
                <th>Дата приготовления</th>
                <th>Дата доставки</th>
            </thead>
            <tbody>
                @foreach ($order->rations as $ration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ration->cooking_date }}</td>
                        <td>{{ $ration->delivery_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>