<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Models\Role;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('view-any', Role::class);
        $roles = Role::with('permissions:permission')->paginate();
        return view('dashboard.roles.index', compact('roles'));
    } // end of index
    public function create()
    {
        $this->authorize('create', Role::class);
        $role = new Role();
        return view('dashboard.roles.create', compact('role'));
    } // end of create

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);
        $role = Role::createWithPermissions($request);
        session()->flash('success', 'Role created');
        return to_route('dashboard.roles.index');
    } // end of store

    public function edit(Role $role)
    {
        $this->authorize('view', $role);
        $role_permissions = $role->permissions()->pluck('type', 'permission')->toArray();
        return view('dashboard.roles.edit', ['role' => $role, 'role_permissions' => $role_permissions]);
    } // end of edit

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);
        $role->updateWithPermissions($request);
        session()->flash('success', 'Role has been updated successfully');
        return to_route('dashboard.roles.index');
    } // end of update
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
        session()->flash('success', 'Role has been deleted successfully');
        return to_route('dashboard.roles.index');
    } // end of delete
}
