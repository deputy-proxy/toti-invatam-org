<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','description','content','resource_type','audience','category',
        'file_path','external_url','featured_image','author','published_at','active',
    ];

    protected $casts = ['published_at' => 'datetime', 'active' => 'boolean'];

    protected static function booted(): void
    {
        static::creating(function ($m) {
            if (empty($m->slug)) $m->slug = Str::slug($m->title).'-'.Str::lower(Str::random(4));
        });
    }

    public function getRouteKeyName(): string { return 'slug'; }
}
