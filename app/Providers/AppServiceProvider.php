<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Category};
use Illuminate\Support\Facades\View;

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
        $categoriesHF = Category::select('id', 'title', 'category_url')->whereNull('deleted_at')->where('is_active', 1)->get();
        
        View::composer(
            ['layouts.frontheader', 'layouts.frontfooter'],
            function ($view) use ($categoriesHF) {
                $view->with('categoriesHF', $categoriesHF);
            }
        );
    }
}
