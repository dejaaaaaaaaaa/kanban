<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required|string' ,
            'description' => 'required|string' ,
            'status_id'   => 'nullable|integer',
            'priority_id' => 'nullable|integer',
        ];
    }
}
