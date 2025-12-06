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

    public function adminIndex()
    {
        $institutes = Institute::latest()->get();
        return view('admin.institutes.index', compact('institutes'));
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

    public function edit($id)
    {
        $institute = Institute::findOrFail($id);
        
        // Check if user is authorized to edit this institute
        if (auth()->check() && $institute->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('connect-hub.edit', compact('institute'));
    }

    public function update(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);
        
        // Check if user is authorized to edit this institute
        if (auth()->check() && $institute->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $validated = $request->validate([
            'institute_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            // Handle company logo upload
            if ($request->hasFile('company_logo')) {
                // Delete old logo if exists
                if ($institute->company_logo) {
                    Storage::disk('public')->delete($institute->company_logo);
                }
                $companyLogoPath = $request->file('company_logo')->store('company_logos', 'public');
                $institute->company_logo = $companyLogoPath;
            }

            // Handle certificate upload
            if ($request->hasFile('certificate')) {
                // Delete old certificate if exists
                if ($institute->certificate_showcase) {
                    Storage::disk('public')->delete($institute->certificate_showcase);
                }
                $certificatePath = $request->file('certificate')->store('certificates', 'public');
                $institute->certificate_showcase = $certificatePath;
            }

            // Handle gallery uploads
            if ($request->hasFile('gallery')) {
                // Delete old gallery images if exists
                if ($institute->image_gallery) {
                    foreach ($institute->image_gallery as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
                $galleryPaths = [];
                foreach ($request->file('gallery') as $image) {
                    $galleryPaths[] = $image->store('gallery', 'public');
                }
                $institute->image_gallery = $galleryPaths;
            }

            // Update institute data
            $institute->update([
                'institute_name' => $validated['institute_name'],
                'mmcertify_verified' => $request->has('is_verified'),
                'location' => $validated['country'],
                'short_overview' => $validated['overview'],
                'offered_courses' => $validated['courses'],
                'job_opportunities' => $request->jobs ?? [],
                'website' => $request->website,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return redirect()->route('connect-hub')
                ->with('success', 'Institute updated successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Institute update failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->except(['certificate', 'gallery'])
            ]);

            return back()->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $institute = Institute::findOrFail($id);
        
        // Check if user is authorized to delete this institute
        if (auth()->check() && $institute->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Soft delete by changing status from 1 to 0
        $institute->update(['status' => 0]);

        return redirect()->route('admin.institutes')
            ->with('success', 'Institute deleted successfully!');
    }

    public function restore($id)
    {
        $institute = Institute::findOrFail($id);
        
        // Check if user is authorized to restore this institute
        if (auth()->check() && $institute->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Restore by changing status from 0 to 1
        $institute->update(['status' => 1]);

        return redirect()->route('admin.institutes')
            ->with('success', 'Institute restored successfully!');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'institute_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            // Handle company logo upload
            $companyLogoPath = null;
            if ($request->hasFile('company_logo')) {
                $companyLogoPath = $request->file('company_logo')->store('company_logos', 'public');
            }

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
                'company_logo' => $companyLogoPath,
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
            if (isset($companyLogoPath)) {
                Storage::disk('public')->delete($companyLogoPath);
            }
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