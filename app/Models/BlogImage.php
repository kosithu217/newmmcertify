<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = [
        'blog_id',
        'image_path',
        'alt_text'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
