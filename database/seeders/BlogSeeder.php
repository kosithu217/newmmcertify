<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Create a sample blog post
        $blog = Blog::create([
            'title' => 'Welcome to Our Blog',
            'body' => 'This is our first blog post. Here you can find interesting content about various topics.',
            'status' => true
        ]);

        // Add a featured image
        Storage::disk('public')->put('blogs/featured/sample.jpg', file_get_contents(public_path('images/sample.jpg')));
        $blog->update(['featured_image' => 'blogs/featured/sample.jpg']);

        // Add additional images
        Storage::disk('public')->put('blogs/images/sample1.jpg', file_get_contents(public_path('images/sample1.jpg')));
        Storage::disk('public')->put('blogs/images/sample2.jpg', file_get_contents(public_path('images/sample2.jpg')));

        BlogImage::create([
            'blog_id' => $blog->id,
            'image_path' => 'blogs/images/sample1.jpg',
            'alt_text' => 'Sample Image 1'
        ]);

        BlogImage::create([
            'blog_id' => $blog->id,
            'image_path' => 'blogs/images/sample2.jpg',
            'alt_text' => 'Sample Image 2'
        ]);
    }
}
