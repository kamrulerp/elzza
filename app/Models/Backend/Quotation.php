<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;

    public function files()
    {
        return $this->hasMany(QuotationFile::class);
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'product_type',
        'execution_timeframe',
        'upload_file',
        'description',
        'status'
    ];

}