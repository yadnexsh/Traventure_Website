<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalIdentity extends Model
{
    protected $fillable = ['user_id', 'provider', 'provider_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
