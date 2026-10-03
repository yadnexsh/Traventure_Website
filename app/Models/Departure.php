<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departure extends Model
{
    use HasFactory;
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

    public function getOnlineAvailabilityAttribute()
    {
        $activeAllocations = $this->seatAllocations()
            ->whereNull('released_at')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->count();

        $available = $this->total_capacity - $this->unused_offline_reserved_capacity - $activeAllocations;
        return max(0, $available);
    }
}
