<?php

namespace App\Http\Controllers;

use App\Models\Backend\Quotation;
use App\Models\Backend\GeneralSetting;
use App\Http\Requests\QuotationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Mail\QuotationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::latest()->paginate(10);
        return view('backend.quotations.index', compact('quotations'));
    }

    public function create()
    {
        return view('backend.quotations.create');
    }

    public function store(QuotationRequest $request)
    {
        $quotation = Quotation::create($request->validated());

        $generalSettings = GeneralSetting::first();

        // Send confirmation email synchronously (simple, reliable)
        try {
            if (!empty($quotation->email)) {
                Mail::to($quotation->email)->send(new QuotationMail($quotation));
                Mail::to($generalSettings->site_email)->send(new QuotationMail($quotation)); // Send copy to site email
                Log::info('Quotation confirmation email sent', ['quotation_id' => $quotation->id, 'email' => $quotation->email]);
            } else {
                Log::warning('Quotation created without email, skipping confirmation send', ['quotation_id' => $quotation->id]);
            }
        } catch (\Throwable $e) {
            // Log but don't block user flow; the quotation is saved
            Log::error('Failed to send quotation confirmation email', [
                'quotation_id' => $quotation->id,
                'email' => $quotation->email ?? null,
                'error' => $e->getMessage(),
            ]);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = 'quotation_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    
                    // Store file in the public disk under quotations directory
                    $path = Storage::disk('public')->putFileAs(
                        'quotations',
                        $file,
                        $filename
                    );

                    $quotation->files()->create([
                        'filename' => $filename,
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize()
                    ]);
                }
            }
        }

        return redirect()->route('quotations.index')->with('success', 'Quotation created successfully.');
    }

    public function show(Quotation $quotation)
    {
        return view('backend.quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        return view('backend.quotations.edit', compact('quotation'));
    }

    public function update(QuotationRequest $request, Quotation $quotation)
    {
        $quotation->update($request->validated());

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = 'quotation_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    
                    // Store file in the public disk under quotations directory
                    $path = Storage::disk('public')->putFileAs(
                        'quotations',
                        $file,
                        $filename
                    );

                    $quotation->files()->create([
                        'filename' => $filename,
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize()
                    ]);
                }
            }
        }

        return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');
    }

    public function destroy(Quotation $quotation)
    {
        // Delete associated files
        foreach ($quotation->files as $file) {
            // Delete file from storage
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $quotation->delete();
        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }
}