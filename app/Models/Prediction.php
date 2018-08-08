<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'scale_id',
        'city_id',
        'partner_id',
        'date',
        'threshold'
    ];

    public function scale()
    {
        return $this->belongsTo(Scale::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
