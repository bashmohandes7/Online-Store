<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Category;
use App\Rules\Filter;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'min:3', 'max:255', 'unique:categories,name', 'filter:php,laravel',
            ],
            'image' => 'image|max:1048576|dimensions:min_width:100,min_height:100',
            'description' => 'max:255',
            'parent_id' => 'nullable|int|exists:categories,id',
            'status' => 'in:active,archived',

        ];
    } // end of on create

    protected function onUpdate()
    {
        return [
            'name' => [
                'required', 'string', 'min:3', 'max:255', 'unique:categories,name', 'filter:php,laravel'
            ],
            'image' => 'image|max:1048576|dimensions:min_width:100,min_height:100',
            'description' => 'max:255',
            'parent_id' => 'nullable|int|exists:categories,id',
            'status' => 'in:active,archived',

        ];
    } // end of on update

    public function rules()
    {
        return request()->isMethod('PUT') || request()->isMethod('PATCH') ?
            $this->onUpdate() : $this->onCreate();
    } // end of rules
} // end of class
