<?php

namespace App\Http\Traits;

use App\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'user_role');
    } // end of roles
    public function hasPermission($permission)
    {
        $denied = $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('permission', $permission)
                  ->where('type', '=', 'deny');
        })->exists();

        if ($denied) {
            return false;
        }

        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('permission', $permission)
                  ->where('type', '=', 'allow');
        })->exists();
    }
} // end class HasRoles
