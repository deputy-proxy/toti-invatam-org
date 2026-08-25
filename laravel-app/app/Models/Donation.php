<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name','donor_email','amount','currency','type','recurring',
        'project_id','payment_provider','payment_reference','status','metadata','donated_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'recurring' => 'boolean',
        'metadata' => 'array',
        'donated_at' => 'datetime',
    ];

    public function project(): BelongsTo { return $this->belongsTo(Project::class); }
}
