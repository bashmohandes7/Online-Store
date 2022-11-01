<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'permission', 'type'];
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    } // end of role
}
