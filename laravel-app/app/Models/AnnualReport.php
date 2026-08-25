<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    use HasFactory;

    protected $fillable = ['title','year','description','file_path','cover_image','published_at','active'];
    protected $casts = ['published_at' => 'datetime', 'active' => 'boolean'];
}
