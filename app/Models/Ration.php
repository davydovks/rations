<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ration extends Model
{
    /** @use HasFactory<\Database\Factories\RationFactory> */
    use HasFactory;

    /**
     * Get the order for this ration
     * @return BelongsTo<Order, Ration>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
