<?php

namespace App\Models\Models\Backend;

use Illuminate\Database\Eloquent\Model;

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
        'youtube_url'
    ];

    // Define validation rules for required fields
    public static $rules = [
        'site_name' => 'required',
        'site_email' => 'required|email',
        'site_phone' => 'required',
        'site_address' => 'required',
        'logo' => 'required',
        'favicon' => 'required'
    ];
}
