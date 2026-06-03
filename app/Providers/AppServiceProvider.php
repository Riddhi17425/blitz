<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Category, Country, Product, Setting};
use Illuminate\Support\Facades\Schema;
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
        $categoriesHF = Category::whereNull('deleted_at')
            ->where('is_active', 1)
            ->with(['subCategories' => function ($query) {
                $query->where('is_active', 1);
            }, 'subCategories.products' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->get();
        
        View::composer(
            ['layouts.frontheader', 'layouts.frontfooter'],
            function ($view) use ($categoriesHF) {
                $view->with('categoriesHF', $categoriesHF);
            }
        );

        View::composer('*', function ($view) {
            $view->with('industryT', "Protecting Tomorrow's Powerful Infrastructure");
            $view->with('industryD', "Industries choose Blitz when system protection, uptime, and electrical safety cannot be compromised.");
        });

        View::composer('layouts.form', function ($view) {
            $countries = collect();
            $products = collect();

            if (Schema::hasTable('countries')) {
                $countries = Country::select('id', 'name')->orderBy('name')->get();
            }
            if (Schema::hasTable('products')) {
                $products = Product::select('id', 'product_name')->whereNull('deleted_at')->where('is_active', 1)->orderBy('product_name')->get();
            }
            if (Schema::hasTable('settings')) {
                $settings = Setting::select('id', 'phone', 'email', 'head_office_address')->first();
            }

            $view->with('countries', $countries)->with('products', $products)->with('settings', $settings);
        });
    }
}
