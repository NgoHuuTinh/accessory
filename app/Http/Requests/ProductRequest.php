<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if ($this->isMethod('POST')) {
            $rules = [
                'name' => 'required|unique:m_products,name,' . $this->id,
                'product_id' => 'nullable',
                'purchase_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
                'head_price' => 'nullable|numeric',
            ];
        }
        
        return $rules;
    }

    /**
     * Get custom attributes for validator errors
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên thiết bị là một trường bắt buộc',
            'name.unique' => 'Tên thiết bị này đã được sử dụng, hãy nhập 1 tên thiết bị khác',
            'purchase_price.required' => 'Giá mua vào là một trường bắt buộc',
            'purchase_price.numeric' => 'Giá mua vào phải là 1 số',
            'sale_price.required' => 'Tên thiết bị là một trường bắt buộc',
            'sale_price.numeric' => 'Giá bán ra phải là 1 số',
            'head_price.numeric' => 'Giá của HEAD phải là 1 số',
        ];
    }
}
