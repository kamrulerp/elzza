<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GeneralSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_email', 
        'site_phone',
        'site_address',
        'logo',
        'favicon',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
    ];

    /**
     * Boot method to handle cache clearing
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when settings are updated
        static::saved(function () {
            Cache::forget('general_settings');
            
            // Refresh the cached settings
            $settings = static::first();
            if ($settings) {
                Cache::forever('general_settings', $settings->toArray());
                app()->instance('settings', $settings->toArray());
            }
        });

        static::deleted(function () {
            Cache::forget('general_settings');
            app()->instance('settings', []);
        });
    }

    /**
     * Get the first (and only) settings record
     */
    public static function getSettings()
    {
        return static::first() ?? new static();
    }
}