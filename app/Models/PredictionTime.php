<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredictionTime extends Model
{
    protected $fillable = [
        'prediction_id',
        'time',
        'value'
    ];

    public $timestamps = false;

    public function prediction()
    {
        return $this->belongsTo(Prediction::class);
    }
}
