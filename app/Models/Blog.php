<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'body',
        'featured_image',
        'status'
    ];

    protected $with = ['images'];

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
    
    // Model class methods go here
    public function getUrl()
    {
        return url('/blog/' . $this->id);
    }
}
