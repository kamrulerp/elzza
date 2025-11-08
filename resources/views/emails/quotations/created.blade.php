@extends('emails.layout')

@section('content')
<div style="padding: 20px; background-color: #ffffff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h2 style="color: #333; margin-bottom: 20px;">Quotation Confirmation</h2>
    
    <p>Dear {{ $quotation->name ?? 'Valued Customer' }},</p>
    
    <p>Thank you for submitting your quotation. We have received your request and will review it shortly.</p>
    
    <div style="margin: 20px 0; padding: 15px; background-color: #f8f9fa; border-radius: 4px;">
        <h3 style="color: #444; margin-bottom: 15px;">Quotation Details:</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 10px;"><strong>Quotation ID:</strong> #{{ $quotation->id ?? 'N/A' }}</li>
            <li style="margin-bottom: 10px;"><strong>Product Type:</strong> {{ $quotation->product_type ?? 'N/A' }}</li>
            <li style="margin-bottom: 10px;"><strong>Execution Timeframe:</strong> {{ $quotation->execution_time ?? 'N/A' }}</li>
            <li style="margin-bottom: 10px;"><strong>Status:</strong> {{ ucfirst($quotation->status ?? 'pending') }}</li>
        </ul>
    </div>
    
    <p>We will contact you soon to discuss your requirements in detail. If you have any questions in the meantime, please don't hesitate to contact us.</p>
    
    <div style="margin-top: 30px;">
        <p>Best Regards,<br>{{ config('app.name') }} Team</p>
    </div>
</div>
@endsection
