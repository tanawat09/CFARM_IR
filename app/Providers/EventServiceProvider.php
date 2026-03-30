<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\User;
use App\Models\News;
use App\Models\Event as EventModel;
use App\Models\Document;
use App\Models\FinancialReport;
use App\Models\BoardDirector;
use App\Models\ShareholdingStructure;
use App\Observers\AuditObserver;
use App\Listeners\LogAuthenticationEvents;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LogAuthenticationEvents::class . '@handleLogin',
        ],
        Logout::class => [
            LogAuthenticationEvents::class . '@handleLogout',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(AuditObserver::class);
        News::observe(AuditObserver::class);
        EventModel::observe(AuditObserver::class);
        Document::observe(AuditObserver::class);
        FinancialReport::observe(AuditObserver::class);
        BoardDirector::observe(AuditObserver::class);
        ShareholdingStructure::observe(AuditObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
