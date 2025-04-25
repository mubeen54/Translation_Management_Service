<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTranslationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'locale' => 'required|string',
            'key' => 'required|string|unique:transaltions,key',
            'value' => 'required|string',
            'tags' => 'array'
        ];
    }
}