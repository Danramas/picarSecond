<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    public function mark()
    {
        return $this->belongsTo(CarMark::class);
    }

    public function modifications()
    {
        return $this->hasMany(CarModification::class);
    }
    protected $table='models';
}
