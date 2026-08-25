<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','type','description','logo','website','email','phone',
        'address','city','county','country','active',
    ];

    protected $casts = ['active' => 'boolean'];

    public const TYPES = [
        'company' => 'Companie',
        'school' => 'Școală',
        'university' => 'Universitate',
        'ngo' => 'ONG',
        'public_institution' => 'Instituție publică',
        'educational_organization' => 'Organizație educațională',
        'other' => 'Alta',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name).'-'.Str::lower(Str::random(4));
            }
        });
    }

    public function partner(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Partner::class);
    }

    public function people(): HasMany { return $this->hasMany(Person::class); }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_partners')
            ->withPivot('role', 'contribution', 'featured')
            ->withTimestamps();
    }
}
