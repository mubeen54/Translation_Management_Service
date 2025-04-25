<?php

namespace App\Http\Controllers;

use App\Models\Transaltion;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        return Transaltion::when($request->tag, fn($q) => $q->whereJsonContains('tags', $request->tag))
            ->when($request->key, fn($q) => $q->where('key', 'like', "%{$request->key}%"))
            ->when($request->value, fn($q) => $q->where('value', 'like', "%{$request->value}%"))
            ->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'locale' => 'required|string',
            'key' => 'required|string|unique:translations,key',
            'value' => 'required|string',
            'tags' => 'array'
        ]);
       
        return Transaltion::create($data);
    }

    public function update(Request $request, Transaltion $translation)
    {
        $data = $request->validate([
            'locale' => 'required|string',
            'key' => 'required|string',
            'value' => 'required|string',
            'tags' => 'array'
        ]);
        $translation->update($data);
        return $translation;
    }

    public function show(Transaltion $translation)
    {
        return $translation;
    }

    public function export($locale)
    {
        $translations = Transaltion::where('locale', $locale)->get(['key', 'value']);
        return response()->json($translations->pluck('value', 'key'));
    }
}
