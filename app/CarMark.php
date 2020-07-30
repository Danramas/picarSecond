<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarMark extends Model
{
    protected $table='marks';

    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
}
