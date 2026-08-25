<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id','partner_type','partnership_description','contribution_type',
        'start_date','active','featured','display_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'start_date' => 'date',
    ];

    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }

    public function scopeActive($q) { return $q->where('active', true); }
    public function scopeFeatured($q) { return $q->where('featured', true); }
}
