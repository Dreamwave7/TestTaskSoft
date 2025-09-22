<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchGoogleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search_word' => 'string|max:500|min:2',
            'name_site' => 'string|max:50|min:3',
            'language' => 'string|min:4',
            'location' => 'string|min:2',
        ];
    }
}
