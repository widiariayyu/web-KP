<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Fungsi;

class TaksiPerusahaan extends Model
{
  public $timestamps = false;
  protected $guarded = [];
  public $incrementing = false;
  protected $table = 'perusahaantaksi';

  public function katperusahaan()
  {
    return $this->belongsTo('App\Mkategoriperusahaan', 'mkategoriperusahaan_id');
  }

  public function wilayah()
  {
    return $this->belongsTo('App\Mwilayah', 'mwilayah_id');
  }

  public function perubahansifats()
  {
    return $this->hasMany('App\Mperubahansifat');
  }

  public function scopeNoUnik($query)
  {
    $id = $query->select('id')->orderBy('id', 'DESC')->pluck('id')->first();
    return Fungsi::autoNumber(!empty($id) ? $id : '00',0,2);
  }
}
