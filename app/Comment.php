<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Unknown author'
        ]);
    }

    protected $fillable = [
        'text', 'advert_id', 'user_id',
    ];
}
