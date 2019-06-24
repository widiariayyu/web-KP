<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mmerk extends Model
{
    public $timestamps = false;
    protected $fillable = ['merk'];

    public function perubahansifats()
    {
        return $this->hasMany('App\Mperubahansifat');
    }
}
