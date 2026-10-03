<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatAllocation extends Model
{
    protected $fillable = ['reservation_id', 'departure_id', 'allocation_type', 'expires_at', 'released_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }
}
