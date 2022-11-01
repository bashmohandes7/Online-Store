<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    protected function onCreate()
    {
        return [
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
        ];
    } // end of onCreate
    protected function onUpdate()
    {
        return [
            'name' => 'string|max:255',
            'permissions' => 'array',
        ];
    } // end of onUpdate

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return request()->method('put') || request()->method('patch') ? $this->onUpdate()
        : $this->onCreate();
    } // end of rules
}
