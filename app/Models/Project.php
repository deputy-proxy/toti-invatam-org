<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_category_id', 'title', 'slug', 'short_description', 'description',
        'problem', 'solution', 'objectives', 'impact', 'featured_image', 'gallery',
        'status', 'start_date', 'end_date', 'location', 'county', 'featured', 'published_at',
        'seo_title', 'seo_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'datetime',
    ];

    public const STATUSES = [
        'draft' => 'Ciornă',
        'upcoming' => 'În curând',
        'active' => 'Activ',
        'completed' => 'Finalizat',
        'archived' => 'Arhivat',
    ];

    protected static function booted(): void
    {
        static::creating(function ($m) {
            if (empty($m->slug)) {
                $m->slug = Str::slug($m->title).'-'.Str::lower(Str::random(4));
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'project_partners')
            ->withPivot('role', 'contribution', 'featured')->withTimestamps();
    }

    public function educators(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'project_educators')
            ->withPivot('role', 'hours', 'contribution')->withTimestamps();
    }

    public function beneficiaries(): BelongsToMany
    {
        return $this->belongsToMany(Beneficiary::class, 'project_beneficiaries')
            ->withPivot('number_of_beneficiaries', 'notes')->withTimestamps();
    }

    public function impactMetrics(): HasMany
    {
        return $this->hasMany(ImpactMetric::class);
    }

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at')
            ->whereIn('status', ['active', 'completed', 'upcoming']);
    }

    public function scopeFeatured($q)
    {
        return $q->where('featured', true);
    }
}
