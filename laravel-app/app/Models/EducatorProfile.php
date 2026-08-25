<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducatorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id','educator_type','subjects','skills','experience',
        'availability','preferred_age_groups','preferred_locations','online_available',
    ];

    protected $casts = [
        'subjects' => 'array',
        'skills' => 'array',
        'preferred_age_groups' => 'array',
        'preferred_locations' => 'array',
        'online_available' => 'boolean',
    ];

    public function person(): BelongsTo { return $this->belongsTo(Person::class); }
}
