<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConnectHubController extends Controller
{
    public function index()
    {
        $institutes = Institute::latest()->get();
        return view('connect-hub', compact('institutes'));
    }

    public function create()
    {
        return view('connect-hub.create');
    }

    public function show($id)
    {
        $institute = Institute::findOrFail($id);
        return view('connect-hub.show', compact('institute'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'institute_name' => 'required|string|max:255',
            'is_verified' => 'nullable',
            'country' => 'required|string|max:255',
            'overview' => 'required|string',
            'courses' => 'required|array',
            'courses.*.name' => 'required|string|max:255',
            'courses.*.duration' => 'required|string|max:100',
            'certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'jobs' => 'nullable|array',
            'jobs.*' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            // Handle certificate upload
            $certificatePath = null;
            if ($request->hasFile('certificate')) {
                $certificatePath = $request->file('certificate')->store('certificates', 'public');
            }

            // Handle gallery uploads
            $galleryPaths = [];
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    $galleryPaths[] = $image->store('gallery', 'public');
                }
            }

            // Prepare data for creation
            $data = [
                'user_id' => auth()->check() ? auth()->id() : null,
                'institute_name' => $validated['institute_name'],
                'mmcertify_verified' => $request->has('is_verified'),
                'location' => $validated['country'],
                'short_overview' => $validated['overview'],
                'offered_courses' => $validated['courses'],
                'certificate_showcase' => $certificatePath,
                'job_opportunities' => $request->jobs ?? [],
                'website' => $request->website,
                'phone' => $request->phone,
                'email' => $request->email,
                'image_gallery' => $galleryPaths
            ];

            // Create new institute
            $institute = Institute::create($data);

            return redirect()->route('connect-hub')
                ->with('success', 'Institute added successfully!');

        } catch (\Exception $e) {
            // Delete uploaded files if there was an error
            if (isset($certificatePath)) {
                Storage::disk('public')->delete($certificatePath);
            }
            if (!empty($galleryPaths)) {
                foreach ($galleryPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }

            // Log the error for debugging
            \Log::error('Institute creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->except(['certificate', 'gallery'])
            ]);

            return back()->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}