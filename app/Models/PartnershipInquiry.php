<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisation_name', 'contact_name', 'email', 'phone', 'website',
        'organisation_type', 'partnership_type', 'message', 'budget', 'status', 'admin_notes',
    ];
}
