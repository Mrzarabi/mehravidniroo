<?php

namespace App\Http\Requests\V1\Product;

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
        return [
            'title'          => 'required|string|max:50',
            'desc'           => 'nullable|string|max:255',
            'body'           => 'nullable|string',
            'u_price'           => 'nullable|integer|min:0',
            'c_price'           => 'nullable|integer|min:0',
            'inventory'           => 'nullable|integer|min:0',
            'code'           => 'nullable|integer',

            /**
             * Relations
             */

             'categories.*' => 'nullable|integer|exists:categories,id',
        ];
    }
}
