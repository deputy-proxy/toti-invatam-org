<?php

namespace App\Providers;

use App\Services\PaymentService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaymentService::class, fn () => new PaymentService(
            config('services.payments.provider', 'null')
        ));
    }

    public function boot(): void
    {
        Paginator::useTailwind();
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
            URL::forceRootUrl(config('app.url'));
        }
    }
}
