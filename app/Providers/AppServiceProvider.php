<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Checklist\ChecklistRepository;
use App\Repositories\Checklist\ChecklistRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
          ChecklistRepositoryInterface::class, 
            ChecklistRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
