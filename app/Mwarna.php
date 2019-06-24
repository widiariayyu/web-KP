<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mwarna extends Model
{
  public $timestamps = false;
  protected $fillable = ['warna'];

  public function kp()
  {
      return $this->hasMany('App\Txkp', 'warna');
  }
}
