<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpressionOfInterest extends Model
{
    protected $fillable = ['departure_id', 'name', 'email', 'phone', 'consent_status'];

    protected $casts = [
        'consent_status' => 'boolean',
    ];

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }
}
