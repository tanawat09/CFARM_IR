<?php

namespace App\Services;

use App\Models\News;
use App\Models\Document;
use App\Models\FinancialReport;
use App\Models\Event;

class SearchService
{
    public function search(string $query)
    {
        $results = collect();
        $escapedQuery = addcslashes($query, '\\%_');

        $news = News::published()
            ->where(function ($q) use ($escapedQuery) {
                $q->where('title_th', 'like', "%{$escapedQuery}%")
                  ->orWhere('title_en', 'like', "%{$escapedQuery}%")
                  ->orWhere('content_th', 'like', "%{$escapedQuery}%")
                  ->orWhere('content_en', 'like', "%{$escapedQuery}%");
            })
            ->limit(10)->get()
            ->map(fn ($item) => ['type' => 'news', 'item' => $item]);

        $documents = Document::where(function ($q) use ($escapedQuery) {
                $q->where('title_th', 'like', "%{$escapedQuery}%")
                  ->orWhere('title_en', 'like', "%{$escapedQuery}%");
            })
            ->limit(10)->get()
            ->map(fn ($item) => ['type' => 'document', 'item' => $item]);

        $reports = FinancialReport::where(function ($q) use ($escapedQuery) {
                $q->where('title_th', 'like', "%{$escapedQuery}%")
                  ->orWhere('title_en', 'like', "%{$escapedQuery}%");
            })
            ->limit(10)->get()
            ->map(fn ($item) => ['type' => 'financial', 'item' => $item]);

        $events = Event::where(function ($q) use ($escapedQuery) {
                $q->where('title_th', 'like', "%{$escapedQuery}%")
                  ->orWhere('title_en', 'like', "%{$escapedQuery}%");
            })
            ->limit(10)->get()
            ->map(fn ($item) => ['type' => 'event', 'item' => $item]);

        return $results->merge($news)->merge($documents)->merge($reports)->merge($events);
    }
}
