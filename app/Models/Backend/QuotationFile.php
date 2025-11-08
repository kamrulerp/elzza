<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class QuotationFile extends Model
{
    protected $fillable = [
        'quotation_id',
        'filename',
        'original_name',
        'file_path',
        'mime_type',
        'file_size'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}