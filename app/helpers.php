<?php

use App\Models\Backend\GeneralSetting;

if (! function_exists('setting')) {
    /**
     * Get a setting value from cache or database
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        // Try to get from cached settings first (set in AppServiceProvider)
        $settings = app('settings', []);
        
        if (isset($settings[$key])) {
            return $settings[$key];
        }
        
        // Fallback to direct database query if not in cache
        try {
            $settingRow = GeneralSetting::first();
            return $settingRow?->$key ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (! function_exists('settings')) {
    /**
     * Get all settings as array
     *
     * @return array
     */
    function settings()
    {
        return app('settings', []);
    }
}