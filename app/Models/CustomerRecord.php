<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerRecord extends Model
{
    protected $fillable = ['user_id', 'name', 'phone', 'emergency_contact_info'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
