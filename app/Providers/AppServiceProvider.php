<?php

namespace App\Providers;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Repositories\Eloquents\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
    }
}
