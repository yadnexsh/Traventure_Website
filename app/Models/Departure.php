<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    protected $fillable = ['trek_id', 'start_time', 'end_time', 'total_capacity', 'unused_offline_reserved_capacity', 'status'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function trek()
    {
        return $this->belongsTo(Trek::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function seatAllocations()
    {
        return $this->hasMany(SeatAllocation::class);
    }

    public function expressionsOfInterest()
    {
        return $this->hasMany(ExpressionOfInterest::class);
    }
}
