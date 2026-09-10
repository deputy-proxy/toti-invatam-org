<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','role','organisation','category','quote','photo',
        'project_id','featured','active','display_order',
    ];

    protected $casts = ['featured' => 'boolean', 'active' => 'boolean'];

    public const CATEGORIES = [
        'beneficiar' => 'Beneficiar',
        'profesor' => 'Profesor',
        'voluntar' => 'Voluntar',
        'partener' => 'Partener',
    ];

    public function project(): BelongsTo { return $this->belongsTo(Project::class); }

    public function scopeActive($q) { return $q->where('active', true); }
    public function scopeFeatured($q) { return $q->where('featured', true); }
    public function scopeOrdered($q) { return $q->orderBy('display_order')->orderBy('id'); }
}
