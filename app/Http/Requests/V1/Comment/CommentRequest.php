<?php

namespace App\Http\Requests\V1\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body'       => 'required|string',
            'status'       => 'boolean',
            'is_show'       => 'boolean',

            /*Relation*/
            'comment_id'     => 'nullable|integer|exists:comments,id',
            'product_id'    => 'required|integer|exists:products,id',
        ];
    }
}
