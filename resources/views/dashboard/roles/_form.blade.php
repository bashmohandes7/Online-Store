<div class="form-group">
    <label class="form-control-lg">Role Name</label>
    <x-form.input class="form-control-lg" role="input" name="name" :value="$role->name" />
</div>

<fieldset>
    <legend>{{ __('Permissions') }}</legend>

    @foreach (app('permissions') as $permission_code => $permission_name)
        <div class="row mb-2">
            <div class="col-md-6">
                {{ $permission_name }}
            </div>
            <div class="col-md-2">
                <input type="radio" name="permissions[{{ $permission_code }}]" value="allow"
                    @checked(($role_permissions[$permission_code] ?? '') == 'allow')>
                Allow
            </div>
            <div class="col-md-2">
                <input type="radio" name="permissions[{{ $permission_code }}]" value="deny"
                    @checked(($role_permissions[$permission_code] ?? '') == 'deny')>
                Deny
            </div>
            <div class="col-md-2">
                <input type="radio" name="permissions[{{ $permission_code }}]" value="inherit"
                    @checked(($role_permissions[$permission_code] ?? '') == 'inherit')>
                Inherit
            </div>
        </div>
    @endforeach
</fieldset>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
