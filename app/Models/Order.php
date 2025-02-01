<?php

namespace App\Models;

use App\Enums\ScheduleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'scheduleType' => ScheduleType::class,
        ];
    }

    /**
     * Get the tariff for this order
     * @return BelongsTo<Tariff, Order>
     */
    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }

    /**
     * Get all rations for this order
     * @return HasMany<Ration, Order>
     */
    public function rations(): HasMany
    {
        return $this->hasMany(Ration::class);
    }
}
