<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
