<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function test()
    {
        $blog = Blog::create([
            'title' => 'Test Blog Post',
            'body' => 'This is a test blog post created through the controller.',
            'status' => true
        ]);

        BlogImage::create([
            'blog_id' => $blog->id,
            'image_path' => 'blogs/images/test-image.jpg',
            'alt_text' => 'Test Image'
        ]);

        return redirect()->route('admin.blog');
    }

    public function index()
    {   
        $blogs = Blog::with('images')->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }
    
    /**
     * Display the specified blog post for public viewing
     * Including Open Graph meta tags for Facebook sharing
     */
    public function show($id)
    {
        $blog = Blog::where('id', $id)->where('status', true)->firstOrFail();
        $images = BlogImage::where('blog_id', $blog->id)->get();
        
        return view('blog.show', compact('blog', 'images'));
    }

    // public function index()
    // {
    //     $blogs = Blog::with('images')->paginate(10);
    //     return view('admin.blog.index', compact('blogs'));
    // }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog = Blog::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'status' => $request->status ?? true
        ]);

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_' . $featuredImage->getClientOriginalName();
            $featuredPath = 'certificates/images/' . $featuredImageName;
            $destinationPath = public_path('storage/' . $featuredPath);
            
            // Create directory if it doesn't exist
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            
            $featuredImage->move($directory, $featuredImageName);
            $blog->update(['featured_image' => $featuredPath]);
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . rand(1000, 9999) . '_' . $image->getClientOriginalName();
                $path = 'certificates/images/' . $imageName;
                $destinationPath = public_path('storage/' . dirname($path));
                
                // Create directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                $image->move($destinationPath, $imageName);
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image_path' => $path,
                    'alt_text' => $request->alt_text ?? null
                ]);
            }
        }

        return redirect()->route('admin.blog')->with('success', 'Blog post created successfully');
    }

    public function edit(Blog $blog)
    {
        // Explicitly load the blog with its images
        $blog = Blog::with('images')->findOrFail($blog->id);
        
        // Get images from blog_images table
        $images = BlogImage::where('blog_id', $blog->id)->get();
        
        return view('admin.blog.edit', compact('blog', 'images'));
    }

    public function update(Request $request, Blog $blog)
    {
      
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Prepare the update data
        $updateData = [
            'title' => $validated['title'],
            'body' => $validated['body'],
            'status' => $request->status ?? true
        ];

        // Handle featured image update
        if ($request->hasFile('featured_image')) {
            // Delete old featured image if it exists
            if ($blog->featured_image) {
                $oldImagePath = public_path('storage/' . $blog->featured_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Save new featured image
            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_' . $featuredImage->getClientOriginalName();
            $featuredPath = 'certificates/images/' . $featuredImageName;
            $destinationPath = public_path('storage/' . $featuredPath);
            
            // Create directory if it doesn't exist
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            
            // Move the uploaded file
            $featuredImage->move($directory, $featuredImageName);
            
            // Add to update data
            $updateData['featured_image'] = $featuredPath;
        }

        // Perform the update with all data
        $blog->update($updateData);
        
        // Handle multiple images update
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . rand(1000, 9999) . '_' . $image->getClientOriginalName();
                $path = 'certificates/images/' . $imageName;
                $destinationPath = public_path('storage/' . dirname($path));
                
                // Create directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                $image->move($destinationPath, $imageName);
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image_path' => $path,
                    'alt_text' => $request->alt_text ?? null
                ]);
            }
        }

        return redirect()->route('admin.blog')->with('success', 'Blog post updated successfully');
    }

    public function deleteImage($id)
    {
        $image = BlogImage::find($id);
        
        if (!$image) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Image not found']);
            }
            return redirect()->back()->with('error', 'Image not found');
        }
        
        $blogId = $image->blog_id; // Store the blog ID before deleting the image
        
        if ($image->image_path) {
            $imagePath = public_path('storage/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $image->delete();
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Image deleted successfully',
                'blog_id' => $blogId
            ]);
        }
        
        return redirect()->route('admin.blog.edit', $blogId)->with('success', 'Image deleted successfully');
    }

    public function destroy(Blog $blog)
    {
        // Delete featured image if exists
        if ($blog->featured_image) {
            $featuredImagePath = public_path('storage/' . $blog->featured_image);
            if (file_exists($featuredImagePath)) {
                unlink($featuredImagePath);
            }
        }

        // Delete all associated images
        if ($blog->images && count($blog->images) > 0) {
            foreach ($blog->images as $image) {
                $imagePath = public_path('storage/' . $image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $blog->delete();

        return redirect()->route('admin.blog')->with('success', 'Blog post deleted successfully');
    }
}
