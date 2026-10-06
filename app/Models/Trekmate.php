<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trekmate extends Model
{
    protected $fillable = ['reservation_id', 'name', 'email', 'emergency_contact_info'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
