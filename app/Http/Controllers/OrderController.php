<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tariff;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id')->paginate();
        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    public function create()
    {
        $tariffs = Tariff::pluck('ration_name', 'id');
        $scheduleTypes = [
            'EVERY_DAY' => 'Ежедневная доставка',
            'EVERY_OTHER_DAY' => 'Доставка через день на 1 день',
            'EVERY_OTHER_DAY_TWICE' => 'Доставка через день на 2 дня',
        ];
        return view('order.create', compact('tariffs', 'scheduleTypes'));
    }
}
