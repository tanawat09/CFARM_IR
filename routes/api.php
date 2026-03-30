<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\News;
use App\Models\FinancialReport;
use App\Models\Event;
use App\Models\Document;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('api')->prefix('v1')->group(function () {

    // News API
    Route::get('/news', function (Request $request) {
        $validated = validator($request->all(), [
            'per_page' => 'nullable|integer|min:1|max:50',
        ])->validate();

        return News::published()
            ->with(['category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate($validated['per_page'] ?? 10);
    });

    Route::get('/news/{slug}', function (string $slug) {
        return News::published()
            ->with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();
    });

    // Financial Reports API
    Route::get('/financial-reports', function (Request $request) {
        $validated = validator($request->all(), [
            'per_page' => 'nullable|integer|min:1|max:50',
        ])->validate();

        return FinancialReport::with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($validated['per_page'] ?? 15);
    });

    // Events API
    Route::get('/events', function (Request $request) {
        $validated = validator($request->all(), [
            'per_page' => 'nullable|integer|min:1|max:50',
        ])->validate();

        return Event::with('eventType')
            ->orderBy('event_start', 'desc')
            ->paginate($validated['per_page'] ?? 10);
    });

    Route::get('/events/upcoming', function () {
        return Event::where('event_start', '>=', now())
            ->with('eventType')
            ->orderBy('event_start')
            ->limit(10)
            ->get();
    });

    // Documents API
    Route::get('/documents', function (Request $request) {
        $validated = validator($request->all(), [
            'per_page' => 'nullable|integer|min:1|max:50',
        ])->validate();

        return Document::with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($validated['per_page'] ?? 15);
    });
});
