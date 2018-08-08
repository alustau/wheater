<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    protected $fillable = [
        'name',
        'formula',
        'formula_rollback'
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}
