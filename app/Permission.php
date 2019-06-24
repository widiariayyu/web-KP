<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['nama_permission'];
    
    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }

    public function users()
    {
      return $this->hasManyThrough('App\User', 'App\Role');
    }
}
