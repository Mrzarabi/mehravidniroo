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
            'name' => [ auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') 
                ? ['nullable', 'string', 'max:255'] 
                : ['required', 'string',' max:255'] ],

            'email' => [ auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') 
                ? ['nullable', 'string', 'email', 'max:255'] 
                : ['required', 'string', 'email',' max:255'] ],

            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'phone_number' => 'nullable|regex:/^09[0-9]{9}$/',
            
            'image'          => [
                'nullable', 'image', 'mimes:jpeg,jpg,png,gif',
            ],

            /**
             * Relations
             */

            'tickets.*' => 'nullable|integer|exists:tickets,id',
        ];
    }
}
