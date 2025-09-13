<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $profiles = Profile::where('user_id', auth()->id())->get();
        return view('profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:255',
        'color' => 'nullable|string|max:20',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'weblink' => 'nullable|string|max:255',
    ]);

    $logoPath = null; // Initialize logoPath
    if ($request->hasFile('logo')) {
        $destinationPath = public_path() . '_html/storage/certificates/logos';
        $logo = $request->file('logo');
        $logoFileName = uniqid() . '.' . $logo->getClientOriginalName();
        
        // Create directory if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $logo->move($destinationPath, $logoFileName);
        $logoPath = 'storage/certificates/logos/' . $logoFileName;
    }

    $profile = Profile::create([
        'user_id' => auth()->id(),
        'name' => $validated['name'],
        'phone' => $validated['phone'] ?? null,
        'email' => $validated['email'] ?? null,
        'address' => $validated['address'] ?? null,
        'color' => $validated['color'] ?? null,
        'logo' => $logoPath,
        'weblink' => $validated['weblink'] ?? null,
    ]);

    return redirect()->route('user.profile')->with('success', 'Profile created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'weblink' => 'nullable|string|max:255',
        ]);
    
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $destinationPath = public_path() . '_html/storage/certificates/logos';
            $logo = $request->file('logo');
            $logoFileName = uniqid() . '.' . $logo->getClientOriginalName();
            
            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $logo->move($destinationPath, $logoFileName);
            $profile->logo = 'storage/certificates/logos/' . $logoFileName;
        }
    
        $profile->name = $validated['name'];
        $profile->phone = $validated['phone'] ?? null;
        $profile->email = $validated['email'] ?? null;
        $profile->address = $validated['address'] ?? null;
        $profile->color = $validated['color'] ?? null;
        $profile->weblink = $validated['weblink'] ?? null;
        $profile->save();
    
        return redirect()->route('user.profile', $profile->id)->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
