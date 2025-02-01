<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tariff extends Model
{
    /** @use HasFactory<\Database\Factories\TariffFactory> */
    use HasFactory;

    /**
     * Get all orders with this tariff
     * @return HasMany<Order, Tariff>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
