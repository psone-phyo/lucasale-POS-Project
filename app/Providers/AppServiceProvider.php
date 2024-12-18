<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Pagination\Paginator;
=======
use Illuminate\Pagination\Paginator as PaginationPaginator;
>>>>>>> 3aa2a25
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
<<<<<<< HEAD
        Paginator::useBootstrap();
=======
        PaginationPaginator::useBootstrap();
>>>>>>> 3aa2a25
    }
}
