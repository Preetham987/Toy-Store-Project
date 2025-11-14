<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Brand;
use App\Models\Series;
use App\Models\FeaturedIn;
use App\Models\Character;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
public function boot()
{
    // Sidebar - Categories
    View::composer('frontend.layouts.sidebar', function ($view) {
        $categories = Category::withCount('products')->get();
        $view->with('categories', $categories);
    });

    // Sidebar - Product Types
    View::composer('frontend.layouts.sidebar', function ($view) {
        $productTypes = ProductType::withCount('products')->get();
        $view->with('productTypes', $productTypes);
    });

    // Sidebar - Brands
    View::composer('frontend.layouts.sidebar', function ($view) {
        $brands = Brand::withCount('products')->get();
        $view->with('brands', $brands);
    });
    // Sidebar - Series
    View::composer('frontend.layouts.sidebar', function ($view) {
        $series = Series::withCount('products')->get();
        $view->with('series', $series);
    });
    // Sidebar - Featuredin
    View::composer('frontend.layouts.sidebar', function ($view) {
        $featuredin = FeaturedIn::withCount('products')->get();
        $view->with('featuredin', $featuredin);
    });
    // Sidebar - Character
    View::composer('frontend.layouts.sidebar', function ($view) {
        $character = Character::withCount('products')->get();
        $view->with('character', $character);
    });
    // Sidebar - Company
    View::composer('frontend.layouts.sidebar', function ($view) {
        $companies = \App\Models\Company::withCount('products')->get();
        $view->with('companies', $companies);
    });
    // Sidebar - Scale
        View::composer('frontend.layouts.sidebar', function ($view) {
        $scales = \App\Models\Scale::withCount('products')->get();
        $view->with('scales', $scales);
    });
    // Sidebar - Size
    View::composer('frontend.layouts.sidebar', function ($view) {
        $sizes = \App\Models\Size::withCount('products')->get();
        $view->with('sizes', $sizes);
    });
}
}
