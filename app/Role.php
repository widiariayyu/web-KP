<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['nama_role'];

    public function users()
    {
      return $this->belongsToMany('App\User');
    }

    public function permissions()
    {
      return $this->belongsToMany('App\Permission');
    }

    public function addPermission($permission)
    {
      if ($permission) {
          $permission = Permission::where('id', $permission)->first();
      }

      return $this->permissions()->attach($permission);
    }

    public function removePermission($permission)
    {
      if ($permission) {
          $permission = Permission::where('id', $permission)->first();
      }

      return $this->permissions()->detach($permission);
    }
}
