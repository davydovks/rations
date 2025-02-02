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

    private ?int $rationsPerDay;
    private ?int $cycle;

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
        $this->applyScheduleType();

        $firstDate = Carbon::parse($this->first_date);
        $lastDate = Carbon::parse($this->last_date);
        $this->createRationsFromDates($firstDate, $lastDate);
    }

    public function createRationsFromRanges(array $dateranges)
    {
        $this->applyScheduleType();

        foreach ($dateranges as $range) {
            $dates = explode(' - ', $range);
            $firstDate = Carbon::createFromFormat('Y.m.d',$dates[0]);
            $lastDate = Carbon::createFromFormat('Y.m.d',$dates[1]);
            $this->createRationsFromDates($firstDate, $lastDate);
        }
    }

    private function applyScheduleType() 
    {
        switch ($this->schedule_type) {
            case ScheduleType::EveryDay:
                $this->rationsPerDay = 1;
                $this->cycle = 1;
                break;
            case ScheduleType::EveryOtherDay:
                $this->rationsPerDay = 1;
                $this->cycle = 2;
                break;
            case ScheduleType::EveryOtherDayTwice:
                $this->rationsPerDay = 2;
                $this->cycle = 2;
                break;
        }
    }

    private function createRationsFromDates(Carbon $startDate, Carbon $endDate)
    {
        for ($date = $startDate; $date->diffInDays($endDate)>=0; $date->addDays($this->cycle)) {
            $count = $date->diffInDays($endDate) == 0 ? 1 : $this->rationsPerDay;
            Ration::factory($count)
                ->for($this)
                ->create([
                    'cooking_date' => $this->tariff->cooking_day_before ? $date->copy()->subDay() : $date,
                    'delivery_date' => $date,
                ]);
        }
    }
}
