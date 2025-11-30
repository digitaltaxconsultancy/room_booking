<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'user_id',
        'customer_name',
        'customer_email',
        'check_in_date',
        'check_out_date',
        'status',
       // 'total_amount'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        //'total_amount' => 'decimal:2',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}