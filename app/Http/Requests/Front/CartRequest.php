<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
        return  [
            'product_id' => 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1'
        ];
    } // end of onCreate

    protected function onUpdate()
    {
        return [
            'quantity' => 'nullable|int|min:1',
        ];
    } // end of onUpdate

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    } // end of rules
}
