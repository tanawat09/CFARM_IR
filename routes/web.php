<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IRHomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GovernanceController;
use App\Http\Controllers\ShareholderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuditLogController;

/*
|--------------------------------------------------------------------------
| Public IR Routes
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['th', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [IRHomeController::class, 'index'])->name('home');

// News
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Financial Information
Route::get('/financial', [FinancialController::class, 'index'])->name('financial.index');

// Document Library
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
Route::get('/documents/{document}/view', [DocumentController::class, 'view'])->name('documents.view');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Company Information
Route::get('/company/profile', [CompanyController::class, 'profile'])->name('company.profile');
Route::get('/company/board-of-directors', [CompanyController::class, 'boardOfDirectors'])->name('company.board');
Route::get('/company/management-team', [CompanyController::class, 'managementTeam'])->name('company.management');

// Corporate Governance
Route::get('/governance', [GovernanceController::class, 'index'])->name('governance.index');

// Shareholders
Route::get('/shareholders', [ShareholderController::class, 'index'])->name('shareholders.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');

// Search
Route::get('/search', [SearchController::class, 'index'])->middleware('throttle:60,1')->name('search');

/*
|--------------------------------------------------------------------------
| Admin Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // News CRUD
    Route::resource('news', AdminNewsController::class)->except(['show']);

    // Documents Route
    Route::resource('documents', AdminDocumentController::class);
    
    // Events CRUD
    Route::resource('events', AdminEventController::class)->except(['show']);

    // Shareholders Route
    Route::resource('shareholders', \App\Http\Controllers\Admin\ShareholdingStructureController::class);
    
    // Contacts Route
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Website Settings Routes
    Route::get('/settings/company-profile', [\App\Http\Controllers\Admin\SettingController::class, 'companyProfile'])->name('settings.company_profile');
    Route::get('/settings/financial-highlights', [\App\Http\Controllers\Admin\SettingController::class, 'financialHighlights'])->name('settings.financial_highlights');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // Revenue Structures (Dynamic Business Overview)
    Route::resource('revenue-structures', \App\Http\Controllers\Admin\RevenueStructureController::class)->except(['show']);

    // Board CRUD
    Route::resource('board', BoardController::class)->except(['show'])->parameters(['board' => 'director']);

    // Financial Reports
    Route::resource('financial-reports', \App\Http\Controllers\Admin\FinancialReportController::class)->except(['show']);

    // Users Management
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Audit Logs (View Only)
    Route::resource('audit-logs', AuditLogController::class)->only(['index', 'show']);
});

require __DIR__.'/auth.php';
