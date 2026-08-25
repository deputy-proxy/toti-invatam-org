<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','email','phone','bio','profession',
        'organization_id','city','county','profile_photo','active',
    ];

    protected $casts = ['active' => 'boolean'];

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }

    public function educatorProfile(): HasOne { return $this->hasOne(EducatorProfile::class); }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_educators')
            ->withPivot('role','hours','contribution')
            ->withTimestamps();
    }
}
