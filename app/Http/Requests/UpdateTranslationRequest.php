<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranslationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'locale' => 'required|string',
            'key' => 'required|string',
            'value' => 'required|string',
            'tags' => 'array'
        ];
    }
}