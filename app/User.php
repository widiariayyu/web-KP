<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function permissions()
    {
        return $this->hasManyThrough('App\Permission', 'App\Role');
    }

    public function perubahansifats()
    {
        return $this->hasMany('App\Mperubahansifat');
    }

    public function isSuper()
    {
       if ($this->roles->contains('id', 0)) {
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if ($this->isSuper()) {
            return true;
        }

        if (is_string($role)) {
            return $this->role->contains('nama_role', $role);
        }

        return !! $this->roles->intersect($role)->count();
    }

    public function assignRole($role)
    {
        if ($role) {
            $role = Role::where('id', $role)->first();
        }

        return $this->roles()->attach($role);
    }

    public function revokeRole($user)
    {
        if ($user) {
            $user = User::where('id', $user)->first();
        }

        return $this->roles()->detach($user);
    }
}
