<?php

namespace App\Http\Controllers;

use App\Models\DictionaryTerm;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('q');
        $category = $request->query('category');

        $terms = DictionaryTerm::where('is_published', true)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('term', 'like', "%{$keyword}%")
                        ->orWhere('meaning', 'like', "%{$keyword}%");
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->orderBy('term')
            ->paginate(12)
            ->withQueryString();

        $categories = DictionaryTerm::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('dictionary.index', compact(
            'terms',
            'categories',
            'keyword',
            'category'
        ));
    }

    public function show(string $slug)
    {
        $term = DictionaryTerm::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('dictionary.show', compact('term'));
    }
}