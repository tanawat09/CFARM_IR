<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(protected SearchService $searchService) {}

    public function index(Request $request)
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $query = trim((string) ($validated['q'] ?? ''));
        $results = collect();

        if (mb_strlen($query) >= 2) {
            $results = $this->searchService->search($query);
        }

        return view('public.search.index', compact('results', 'query'));
    }
}
