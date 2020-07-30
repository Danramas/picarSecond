<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public function comment()
    {

        return $this->hasMany(Comment::class);
    }

    public function modification()
    {

        return $this->belongsTo(CarModification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name'=>'Unknown author']);
    }

    protected $fillable = [
        'modification_id', 'user_id', 'year', 'img1', 'img2', 'img3', 'img4', 'img5',
    ];
}
