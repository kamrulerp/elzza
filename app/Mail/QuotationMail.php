<?php

namespace App\Mail;

use App\Models\Backend\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class QuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;

    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function build()
    {
        try {
            Log::info('Building quotation email', [
                'quotation_id' => $this->quotation->id,
                'email' => $this->quotation->email
            ]);

            return $this->subject('Quotation Confirmation - ' . config('app.name'))
                       ->view('emails.quotations.created')
                       ->with([
                           'quotation' => $this->quotation
                       ]);
        } catch (\Exception $e) {
            Log::error('Error building quotation email', [
                'error' => $e->getMessage(),
                'quotation_id' => $this->quotation->id ?? null
            ]);
            throw $e;
        }
    }
}