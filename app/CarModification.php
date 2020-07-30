<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModification extends Model
{
    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    protected $table='modifications';
}
