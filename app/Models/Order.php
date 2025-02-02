<?php

namespace App\Models;

use App\Enums\ScheduleType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_name',
        'client_phone',
        'tariff_id',
        'schedule_type',
        'comment',
        'first_date',
        'last_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'schedule_type' => ScheduleType::class,
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

    public function createRations()
    {
        switch ($this->schedule_type) {
            case ScheduleType::EveryDay->value:
                $rationsPerDay = 1;
                $cycle = 1;
                break;
            case ScheduleType::EveryOtherDay->value:
                $rationsPerDay = 1;
                $cycle = 2;
                break;
            case ScheduleType::EveryOtherDayTwice->value:
                $rationsPerDay = 2;
                $cycle = 2;
                break;
        }

        $firstDate = Carbon::parse($this->first_date);
        $lastDate = Carbon::parse($this->last_date);
        for ($date = $firstDate; $date->diffInDays($lastDate)>=0; $date->addDays($cycle)) {
            $count = $date->diffInDays($lastDate) == 0 ? 1 : $rationsPerDay;
            Ration::factory($count)
                ->for($this)
                ->create([
                    'cooking_date' => $this->tariff->cooking_day_before ? $date->copy()->subDay() : $date,
                    'delivery_date' => $date,
                ]);
        }
    }
}
