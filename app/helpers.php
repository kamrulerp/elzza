<?php

use App\Models\Backend\GeneralSetting;

if (! function_exists('setting')) {
    /**
     * Get a setting value with built-in defaults
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        // Define default values for all settings
        $defaultSettings = [
            'site_name' => 'My Website',
            'site_email' => 'info@example.com',
            'site_phone' => '',
            'site_address' => '',
            'logo' => '',
            'favicon' => '',
            'facebook_url' => '',
            'twitter_url' => '',
            'instagram_url' => '',
            'linkedin_url' => '',
            'youtube_url' => '',
        ];

        // Try to get from cached settings first
        $settings = app('settings', []);
        
        if (isset($settings[$key])) {
            return $settings[$key];
        }
        
        // Try database query
        try {
            $settingRow = GeneralSetting::first();
            
            if ($settingRow && isset($settingRow->$key)) {
                return $settingRow->$key;
            }
        } catch (\Exception $e) {
            // Database error, fall through to defaults
        }
        
        // Return provided default, or built-in default, or null
        return $default ?? $defaultSettings[$key] ?? null;
    }
}

if (! function_exists('settings')) {
    /**
     * Get all settings with defaults
     *
     * @return array
     */
    function settings()
    {
        $defaultSettings = [
            'site_name' => 'My Website',
            'site_email' => 'info@example.com',
            'site_phone' => '',
            'site_address' => '',
            'logo' => '',
            'favicon' => '',
            'facebook_url' => '',
            'twitter_url' => '',
            'instagram_url' => '',
            'linkedin_url' => '',
            'youtube_url' => '',
        ];

        $settings = app('settings', []);
        
        // Merge with defaults to ensure all keys exist
        return array_merge($defaultSettings, $settings);
    }
}