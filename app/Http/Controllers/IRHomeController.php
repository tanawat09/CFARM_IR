<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Services\EventService;
use App\Services\FinancialService;
use App\Models\FinancialReport;
use App\Models\BoardDirector;
use App\Models\Document;
use App\Models\Setting;

class IRHomeController extends Controller
{
    public function __construct(
        protected NewsService $newsService,
        protected EventService $eventService,
    ) {}

    public function index()
    {
        $latestNews = $this->newsService->getLatestNews(5);
        $upcomingEvents = $this->eventService->getUpcoming(3);
        $directors = BoardDirector::orderBy('display_order')->limit(4)->get();
        $latestReports = FinancialReport::with('category')->latest()->limit(3)->get();
        $fh = Setting::where('group', 'financial_highlights')->get()->keyBy('key');
        $heroMedia = Setting::where('key', 'cp_hero_media')->first()?->value_th;

        // Fetch highlight document (e.g., latest 56-1 One Report)
        $highlightDocument = Document::with(['category', 'year'])
            ->whereHas('category', function($q) {
                $q->where('name_en', 'like', '%56-1%')
                  ->orWhere('name_th', 'like', '%56-1%');
            })
            ->latest()
            ->first();

        // If no 56-1 report found, just get the latest document
        if (!$highlightDocument) {
            $highlightDocument = Document::with(['category', 'year'])->latest()->first();
        }

        // Fetch 4 latest documents (excluding the highlight one if it exists)
        $latestDocumentsQuery = Document::with(['category', 'year'])->latest();
        if ($highlightDocument) {
            $latestDocumentsQuery->where('id', '!=', $highlightDocument->id);
        }
        $latestDocuments = $latestDocumentsQuery->limit(4)->get();

        $videoUrl = Setting::where('key', 'cp_homepage_video_url')->first()?->value_th;
        $youtubeId = null;
        if ($videoUrl) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $videoUrl, $match);
            $youtubeId = $match[1] ?? null;
        }

        return view('public.home', compact(
            'latestNews', 'upcomingEvents', 'directors', 'latestReports', 'fh', 'heroMedia',
            'highlightDocument', 'latestDocuments', 'youtubeId'
        ));
    }
}
