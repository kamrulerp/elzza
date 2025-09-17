<?php

namespace App\Http\Controllers;

use App\Models\Backend\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = GeneralSetting::first() ?? new GeneralSetting();
        return view('backend.general.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('general-settings.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'nullable|email|max:255',
            'site_phone' => 'nullable|string|max:20',
            'site_address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        // Get the first record or create a new one
        $setting = GeneralSetting::first();
        if (!$setting) {
            $setting = new GeneralSetting();
        }
        
        // Create directory if it doesn't exist
        $uploadPath = public_path('img/general_settings');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }
        
        // Handle file uploads
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo && File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }
            
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move($uploadPath, $logoName);
            $setting->logo = 'img/general_settings/' . $logoName;
        }
        
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($setting->favicon && File::exists(public_path($setting->favicon))) {
                File::delete(public_path($setting->favicon));
            }
            
            $faviconFile = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move($uploadPath, $faviconName);
            $setting->favicon = 'img/general_settings/' . $faviconName;
        }
        
        // Update other fields
        $setting->site_name = $request->site_name;
        $setting->site_email = $request->site_email;
        $setting->site_phone = $request->site_phone;
        $setting->site_address = $request->site_address;
        $setting->facebook_url = $request->facebook_url;
        $setting->twitter_url = $request->twitter_url;
        $setting->instagram_url = $request->instagram_url;
        $setting->linkedin_url = $request->linkedin_url;
        $setting->youtube_url = $request->youtube_url;
        
        $setting->save();
        
        return redirect()->route('general-settings.index')
            ->with('success', 'General settings updated successfully');
    }

    /**
     * Other methods redirect to index since we only have one record
     */
    public function show()
    {
        return redirect()->route('general-settings.index');
    }

    public function edit()
    {
        return redirect()->route('general-settings.index');
    }

    public function update(Request $request)
    {
        return $this->store($request);
    }

    public function destroy()
    {
        return redirect()->route('general-settings.index');
    }
}
