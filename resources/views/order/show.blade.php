<x-layout>
    <div class="grid">
        <h1><a href="/orders/">Заказы</a> > Просмотр</h1>
        <p><span class="attribute">ID</span>{{ $order->id }}</p>
        <p><span class="attribute">Клиент</span>{{ $order->client_name }}</p>
        <p><span class="attribute">Телефон</span>{{ $order->client_phone }}</p>
        <p><span class="attribute">Рацион</span>{{ $order->tariff->ration_name }}</p>
        <p><span class="attribute">Расписание</span>{{ $order->schedule_type }}</p>
        <p><span class="attribute">Дата создания</span>{{ $order->created_at }}</p>
        <p><span class="attribute">Начальная дата</span>{{ $order->first_date }}</p>
        <p><span class="attribute">Конечная дата</span>{{ $order->last_date }}</p>
        <p><span class="attribute">Комментарий</span></p>
        <textarea name="comment" readonly>{{ $order->comment }}</textarea>

        <h2>Рационы</h2>
        <table>
            <thead>
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