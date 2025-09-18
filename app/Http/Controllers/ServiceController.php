<?php

namespace App\Http\Controllers;

use App\Models\Backend\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('backend.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->status = $request->status;

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $uploadPath = public_path('img/services');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $icon = $request->file('icon');
            $iconName = 'service_' . time() . '.' . $icon->getClientOriginalExtension();
            $icon->move($uploadPath, $iconName);
            $service->icon = 'img/services/' . $iconName;
        }

        $service->save();

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('backend.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('backend.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $service->title = $request->title;
        $service->description = $request->description;
        $service->status = $request->status;

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($service->icon && File::exists(public_path($service->icon))) {
                File::delete(public_path($service->icon));
            }

            $uploadPath = public_path('img/services');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $icon = $request->file('icon');
            $iconName = 'service_' . time() . '.' . $icon->getClientOriginalExtension();
            $icon->move($uploadPath, $iconName);
            $service->icon = 'img/services/' . $iconName;
        }

        $service->save();

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete icon file if exists
        if ($service->icon && File::exists(public_path($service->icon))) {
            File::delete(public_path($service->icon));
        }

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully');
    }
}
