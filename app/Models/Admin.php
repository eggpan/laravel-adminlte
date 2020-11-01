<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'locale',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->role->permissions();
    }

    public function hasPermission($permission)
    {
        $permissions = (array)$permission;
        if ($this->isSuperUser()) {
            $allPermissions = Permission::pluck('name')->toArray();
            foreach ($permissions as $p) {
                if (! in_array($p, $allPermissions)) {
                    return false;
                }
            }
            return true;
        }

        $adminPermissions = $this->permissions->pluck('name')->toArray();
        foreach ($permissions as $p) {
            if (! in_array($p, $adminPermissions)) {
                return false;
            }
        }
        return true;
    }

    public function isSuperUser()
    {
        $adminPermissions = $this->permissions->pluck('name')->toArray();
        return in_array('superuser', $adminPermissions);
    }
}
