<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', true)
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();
        
        return view('home', compact('blogs'));
    }
    
    public function blogIndex()
    {
        $blogs = Blog::where('status', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);
        
        return view('blog.index', compact('blogs'));
    }
}
