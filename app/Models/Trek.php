<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trek extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'title', 'summary', 'difficulty', 'duration', 'published_status', 'price'];

    public function departures()
    {
        return $this->hasMany(Departure::class);
    }
}

