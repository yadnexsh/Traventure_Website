<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['customer_record_id', 'departure_id', 'status', 'payment_status', 'price_snapshot'];

    public function customerRecord()
    {
        return $this->belongsTo(CustomerRecord::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function seatAllocations()
    {
        return $this->hasMany(SeatAllocation::class);
    }
}
