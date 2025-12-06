<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $fillable = [
        'user_id',
        'institute_name',
        'company_logo',
        'mmcertify_verified',
        'location',
        'short_overview',
        'offered_courses',
        'certificate_showcase',
        'job_opportunities',
        'website',
        'phone',
        'email',
        'image_gallery',
        'status',
    ];

    protected $casts = [
        'mmcertify_verified' => 'boolean',
        'offered_courses' => 'array',
        'job_opportunities' => 'array',
        'image_gallery' => 'array',
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}