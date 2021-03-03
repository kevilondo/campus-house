<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function thumbnail()
    {
        return $this->hasOne('App\Models\Image');
    }

}
