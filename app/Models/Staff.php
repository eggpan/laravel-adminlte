<?php

namespace App\Models;

use App\Notifications\Staff\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'locale',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'staff_roles')->withTimestamps();
    }

    public function hasRole($roleId)
    {
        foreach ($this->roles as $role) {
            if ($role->id === $roleId) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        foreach($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function isSuperUser()
    {
        foreach($this->roles as $role) {
            if ($role->isSuperUser()) {
                return true;
            }
        }
        return false;
    }

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPasswordNotification($token));
    }
}
