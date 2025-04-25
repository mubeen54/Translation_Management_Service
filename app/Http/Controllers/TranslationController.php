<?php

namespace App\Http\Controllers;

use App\Models\Transaltion;
use Illuminate\Http\Request;
use App\Helpers\Api;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $translations = Transaltion::when($request->tag, fn($q) => $q->whereJsonContains('tags', $request->tag))
            ->when($request->key, fn($q) => $q->where('key', 'like', "%{$request->key}%"))
            ->when($request->value, fn($q) => $q->where('value', 'like', "%{$request->value}%"))
            ->paginate(20);

        return Api::setResponse('translations', $translations);
    }

    public function store(StoreTranslationRequest $request)
    {
        $translation = Transaltion::create($request->validated());
        return Api::setResponse('translation', $translation);
    }

    public function update(UpdateTranslationRequest $request, Transaltion $translation)
    {
        $translation->update($request->validated());
        return Api::setResponse('translation', $translation);
    }

    public function show(Transaltion $translation)
    {
        return Api::setResponse('translation', $translation);
    }

    public function export($locale)
    {
        $translations = Transaltion::where('locale', $locale)->get(['key', 'value']);
        return Api::setResponse('translations', $translations->pluck('value', 'key'));
    }
}
