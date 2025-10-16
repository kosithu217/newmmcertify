<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uniqueId', 'image', 'image_two', 'user_id', 'name', 'student_name', 'course_name', 'logo', 
        'certificate', 'description', 'course_outline', 'generated', 'qrcode', 'attachments', 'certificate_logo'
    ];

    public static function boot()
    {
        parent::boot();

        // Generate unique ID when creating a certificate
        static::creating(function ($model) {
            do {
                $uniqueId = mt_rand(100000, 999999);
            } while (self::where('uniqueId', $uniqueId)->exists());
    
            $model->uniqueId = $uniqueId;
        });
    }
}
