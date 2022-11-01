<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public static function createWithPermissions($request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name'=> $request->name]);
            foreach ($request->permissions as $permission => $value) {
                RolePermission::create([
                    'role_id' => $role->id,
                    'permission' => $permission,
                    'type'=> $value
                ]);
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $role;
    } // end of withPermissions
    public function updateWithPermissions($request)
    {
        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->name,
            ]);
            foreach ($request->post('permissions') as $permission => $value) {
                RolePermission::updateOrCreate([
                    'role_id' => $this->id,
                    'permission' => $permission,
                ], [
                    'type' => $value,
                ]);
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this;
    } // end of withPermissions

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id');
    } // end of Permissions
}
