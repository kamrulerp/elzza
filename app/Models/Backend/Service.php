<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'icon',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Scope for active services
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for inactive services
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
