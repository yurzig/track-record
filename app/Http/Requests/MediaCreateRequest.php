<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaCreateRequest extends FormRequest
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
            'title' => 'string|max:200',
            'link' => 'required|string',
            'placement' => 'required|integer',
            'status' => 'required|integer',
            'editor' => 'required|integer',
            'sort' => 'integer',
        ];
    }
}
