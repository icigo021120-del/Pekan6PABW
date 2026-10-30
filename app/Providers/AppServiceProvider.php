<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Markup pagination yang polos, distyle lewat CSS di layout (tanpa Tailwind/Bootstrap)
        Paginator::useBootstrapFour();
    }
}