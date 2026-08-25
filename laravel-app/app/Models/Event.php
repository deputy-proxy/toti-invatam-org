<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','description','featured_image','location','online','event_url',
        'start_at','end_at','capacity','registration_required','active',
    ];

    protected $casts = [
        'online' => 'boolean',
        'registration_required' => 'boolean',
        'active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($m) {
            if (empty($m->slug)) $m->slug = Str::slug($m->title).'-'.Str::lower(Str::random(4));
        });
    }

    public function getRouteKeyName(): string { return 'slug'; }
}
