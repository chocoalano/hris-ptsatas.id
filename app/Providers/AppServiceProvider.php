<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;

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
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Config Application')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Master Data')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Asset Management')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Project Management')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Blogs')
                    ->collapsed(),
            ]);
        });
    }
}
