<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationalNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'beneficiary_id', 'subject', 'target_age', 'location',
        'urgency', 'estimated_beneficiaries', 'required_skills', 'required_resources', 'status',
    ];

    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
