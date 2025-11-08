<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'product_type' => 'required|in:Window frame,Door frame,Sliding door',
            'execution_time' => 'required|in:ASAP,Within 3 months,3-6 months,To be determined',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'description' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ];
    }
}