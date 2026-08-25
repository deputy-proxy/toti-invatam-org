<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','phone','profession','skills','motivation','availability',
        'preferred_activities','cv_path','status','admin_notes',
    ];

    protected $casts = [
        'preferred_activities' => 'array',
    ];

    public const STATUSES = [
        'pending' => 'În așteptare',
        'reviewing' => 'În evaluare',
        'approved' => 'Aprobat',
        'rejected' => 'Respins',
        'active' => 'Activ',
        'inactive' => 'Inactiv',
    ];
}
