<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use App\Models\Backend\GeneralSetting;

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
        // Check if table exists to avoid errors during migrations
        if (Schema::hasTable('general_settings')) {
            try {
                // Cache settings for performance
                $settings = Cache::rememberForever('general_settings', function () {
                    $settingRow = GeneralSetting::first();
                    return $settingRow ? $settingRow->toArray() : [];
                });
                
                // Share globally via service container
                app()->instance('settings', $settings);
            } catch (\Exception $e) {
                // Handle any database connection issues gracefully
                app()->instance('settings', []);
            }
        } else {
            // If table doesn't exist, provide empty settings
            app()->instance('settings', []);
        }
    }
}

