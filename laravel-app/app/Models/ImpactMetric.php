<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','title','numeric_value','suffix','description',
        'icon','color','display_order','active',
    ];

    protected $casts = ['active' => 'boolean'];

    public function project(): BelongsTo { return $this->belongsTo(Project::class); }

    public function scopeGlobal($q) { return $q->whereNull('project_id'); }
    public function scopeActive($q) { return $q->where('active', true); }
    public function scopeOrdered($q) { return $q->orderBy('display_order')->orderBy('id'); }
}
