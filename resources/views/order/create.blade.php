<x-layout>
    <div class="grid">
        <h1><a href="/orders/" class="link">Заказы</a> > Создать</h1>

        {{ html()->form('POST')->route('orders.store')->open() }}
            {{ html()->label('ФИО клиента','client_name')->class('attribute') }}
            {{ html()->text('client_name') }}
            <br>
            <x-error name="client_name" />
            {{ html()->label('Телефон','client_phone')->class('attribute') }}
            {{ html()->text('client_phone') }}
            <br>
            <x-error name="client_phone" />
            {{ html()->label('Тариф','tariff_id')->class('attribute') }}
            {{ html()->select('tariff_id')
                ->children($tariffs, fn($tariff, $id) => html()->option($tariff, $id))
            }}
            <br>
            {{ html()->label('Расписание','schedule_type')->class('attribute') }}
            {{ html()->select('schedule_type')
                ->children($scheduleTypes, fn($description, $id) => html()->option($description, $id))
            }}
            <br>
            {{ html()->label('Комментарий','comment')->class('attribute align-top') }}
            {{ html()->textarea('comment') }}
            <br>

            {{ html()->submit("Сохранить")->class('btn mt-5') }}
        {{ html()->form()->close() }}
    </div>
</x-layout>