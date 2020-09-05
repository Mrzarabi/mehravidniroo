<?php

namespace App\Http\Requests\V1\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|min:0|max:3|integer',
            'phone_number' => 'nullable|regex:/^(\+98|0)?\d{10}$/',
            
            'image'          => [
                'nullable', 'image', 'mimes:jpeg,jpg,png,gif',
            ],
        ];
    }
}
