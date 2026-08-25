<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'type','name','description','contact_person','email','phone',
        'city','county','address','needs','accessibility_barriers','active',
    ];

    protected $casts = ['active' => 'boolean'];

    public const TYPES = [
        'individual' => 'Persoană',
        'school' => 'Școală',
        'ngo' => 'ONG',
        'community' => 'Comunitate',
        'institution' => 'Instituție',
        'other' => 'Alta',
    ];

    public function educationalNeeds(): HasMany { return $this->hasMany(EducationalNeed::class); }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_beneficiaries')
            ->withPivot('number_of_beneficiaries','notes')
            ->withTimestamps();
    }
}
