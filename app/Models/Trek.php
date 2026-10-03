<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trek extends Model
{
    protected $fillable = ['slug', 'title', 'summary', 'difficulty', 'duration', 'published_status'];

    public function departures()
    {
        return $this->hasMany(Departure::class);
    }
}
