<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function admins()
    {
        return $this->hasMany(Staff::class);
    }

    public function hasPermission($permission)
    {
        if ($this->isSuperUser()) {
            return true;
        }
        $permissions = (array)$permission;

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
