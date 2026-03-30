<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Document;
use App\Models\Event;
use App\Models\ContactMessage;
use App\Models\FinancialReport;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::where('is_published', true)->count(),
            'total_documents' => Document::count(),
            'total_reports' => FinancialReport::count(),
            'total_events' => Event::count(),
            'unresolved_messages' => ContactMessage::count(),
        ];

        $latestNews = News::with('category')->latest()->limit(5)->get();
        $upcomingEvents = Event::where('event_start', '>=', now())->orderBy('event_start')->limit(5)->get();
        $recentMessages = ContactMessage::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'latestNews', 'upcomingEvents', 'recentMessages'));
    }
}
