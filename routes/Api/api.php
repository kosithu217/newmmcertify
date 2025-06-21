<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class RegisterController extends Controller
{
    public function certificate_logo(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|exists:certificates,id',
            'certificate_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Find the certificate by ID
        $certificate = Certificate::find($request->id);

        if ($request->hasFile('certificate_logo')) {
            // Get the uploaded file
            $file = $request->file('certificate_logo');
            
            // Create a unique filename
            $filename = uniqid() . '.cert.' . $file->getClientOriginalExtension();
            
            // Save the file to storage (public disk)
            $path = $file->storeAs('certificates/images', $filename, 'public');

            // Save the file path to the database
            $certificate->certificate_logo = $path;
            $certificate->save();

            // Return success response
            return response()->json([
                'message' => 'Certificate logo updated successfully.',
                'path' => $path
            ], 200);
        }

        // If no image was uploaded
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
