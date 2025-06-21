<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// QR
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Intervention\Image\Decoders\Base64ImageDecoder;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\Typography\FontFactory;
use App\Models\Blog;
class UserController extends Controller
{

    public function index()
    {
        // dd('test');
        return view('admin.index');
    }

    public function certificates()
    {
      
        return view('admin.certificates');
    }

    public function addCertificate()
    {
        $certificate = Certificate::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        
        return view('admin.add_certificate', compact('certificate'));
    }
  public function uploadCertificate(Request $request){
    if(count(Auth::user()->certificates) >= Auth::user()->cert_limit ){
        return redirect()->back()->with('error', 'Your certificate limit has been reached. Please contact us.');
    }
    
    // Validate form input
    $validated = $request->validate([
        'name' => 'required|string',
        'image' => 'required|image|mimes:png|max:2048', // First certificate image
        'image_two' => 'required|image|mimes:png|max:2048', // Second certificate image
        'description' => 'required|string',
        'course_outline' => 'required|string',
        // 'attachments' => 'required|array', // Ensure attachments is an array
        // 'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048', // Validate each file in the array
    ]);

    // Handle Logo Upload
    $logoPath = null; // Initialize logoPath as null

    // Check if the user has an existing certificate with a logo
    $existingCertificate = Certificate::where('user_id', Auth::id())->first();
    if ($existingCertificate && $existingCertificate->logo) {
        $logoPath = $existingCertificate->logo; // Use the existing logo from the database
    }

    // If the user uploads a new logo, override the logoPath
    if ($request->hasFile('logo')) {
        $destinationPath = public_path() . '_html/storage/certificates/logos';
        $logo = $request->file('logo');
        $logoFileName = uniqid() . '.' . $logo->getClientOriginalName();
        $logo->move($destinationPath, $logoFileName);
        $logoPath = 'storage/certificates/logos/' . $logoFileName;
    }

    // Store First Certificate Image
    $destinationPath = public_path() . '_html/storage/certificates/images';
    $cert = $request->file('image');
    $certFileName = uniqid() . '.' . $cert->getClientOriginalName();
    $cert->move($destinationPath, $certFileName);
    $certificatePath = 'storage/certificates/images/' . $certFileName;
    
    // Store Second Certificate Image
    $certTwo = $request->file('image_two');
    $certTwoFileName = uniqid() . '_2.' . $certTwo->getClientOriginalName();
    $certTwo->move($destinationPath, $certTwoFileName);
    $certificateTwoPath = 'storage/certificates/images/' . $certTwoFileName;

    // Handle Attachments
    $uploadedFiles = [];
    if($request->file('attachments')){
        // Loop through and store each uploaded file
        foreach ($request->file('attachments') as $file) {
            $destinationPath = public_path() . '_html/storage/attachments';
            $attach = $file;
            $attachFileName = uniqid() . '.' . $attach->getClientOriginalName();
            $attach->move($destinationPath, $attachFileName);
            $filePath = 'storage/attachments/' . $attachFileName;
            
            $uploadedFiles[] = $filePath;
        }
    }

    // Create a new certificate record
    $certificate = Certificate::create([
        'user_id' => Auth::id(), 
        'name' => $validated['name'],
        'logo' => $logoPath, // Use the logoPath (either existing, new, or null)
        'certificate' => $certificatePath,
        'image_two' => $certificateTwoPath,
        'description' => $validated['description'],
        'course_outline' => $validated['course_outline'],
    ]);

    if($request->file('attachments')){
        $certificate->attachments = serialize($uploadedFiles);
        $certificate->update();
    }

    // Redirect to a page with success message
    return redirect('/user/certificates')->with('success', 'Certificate uploaded successfully!');
}




public function createQR($id)
{
    $certificate = Certificate::findOrFail($id);

    // Generate QR Code
    $qrcodeFileName = $certificate->uniqueId . '.png'; 
    $qrcodePath = public_path() . '_html/storage/certificates/qrcodes/' . $qrcodeFileName;

    $address = "https://mmcertify.com/check-certificate/" . $certificate->uniqueId;

    // QR Code dimensions
    $qrSize = 300;
    $qrPadding = 40;
    $totalHeight = $qrSize + ($qrPadding * 2); // 380px total height

    // Create QR code image
    QrCode::errorCorrection('H')
        ->format('png')
        ->size($qrSize)
        ->generate($address, $qrcodePath);

    $manager = ImageManager::imagick();
    $image = $manager->read($qrcodePath);

    // Create canvas
    $canvas = $manager->create(900, $totalHeight, '#ffffff');
    $canvas->place($image, 'right', $qrPadding, $qrPadding);

    // Text layout settings
    $leftPadding = 50;
    $baseY = $qrPadding + 80;
    $lineSpacing = 70;

    // 1. Certificate ID label
    $canvas->text('Certificate ID', $leftPadding, $baseY, function (FontFactory $font) {
        $font->filename('./fonts/Roboto-Medium.ttf');
        $font->size(45);
        $font->color('#6B3FA0');
        $font->align('left');
    });

    // 2. Unique ID (moved down slightly like one <br>)
    $canvas->text($certificate->uniqueId, $leftPadding, $baseY + $lineSpacing + 30, function (FontFactory $font) {
        $font->filename('./fonts/Roboto-Medium.ttf');
        $font->size(75);
        $font->color('#6B3FA0');
        $font->align('left');
    });

    // 3. Scan QR code text
    $canvas->text('Scan QR code or visit', $leftPadding, $baseY + 2 * $lineSpacing + 30, function (FontFactory $font) {
        $font->filename('./fonts/Roboto-Medium.ttf');
        $font->size(45);
        $font->color('#6B3FA0');
        $font->align('left');
    });

    // 4. URL
    $canvas->text('mmcertify.com/check', $leftPadding, $baseY + 3 * $lineSpacing + 30, function (FontFactory $font) {
        $font->filename('./fonts/Roboto-Medium.ttf');
        $font->size(45);
        $font->color('#6B3FA0');
        $font->align('left');
    });

    // Save the final image
    $canvas->save($qrcodePath);

    // Update certificate
    $certificate->qrcode = 'storage/certificates/qrcodes/' . $qrcodeFileName;
    $certificate->generated = 1;
    $certificate->save();

    return redirect()->back()->with('success', 'QR & Certificate ID generated successfully!');
}



    public function certificateDetail($id){
        $certificate = Certificate::find($id);

        return view('admin.certificate_detail', compact('certificate'));
    }
    
    public function editCertificate($id)
    {
        $certificate = Certificate::find($id);
        
        return view('admin.edit_certificate', compact('certificate'));
    }
    
    public function updateCertificate(Request $request){
        
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string',
            'logo' => $request->logo ? 'required|image|mimes:png|max:10240' : '', // Validate image
            'image' => $request->image ? 'required|image|mimes:png|max:10240' : '', // Validate certificate image
            'description' => 'required|string',
            'course_outline' => 'required|string',
        ]);
        
        $certificate = Certificate::find($request->id);

        // Store Logo
        // $logoPath = $request->file('logo')->store('certificates/logos', 'public'); // Store in 'storage/app/public/certificates/logos'
        if($request->logo){
            $destinationPath = public_path() . '_html/storage/certificates/logos';
            $logo = $request->file('logo');
            $logoFileName = uniqid() . '.' . $logo->getClientOriginalName();
            $logo->move($destinationPath, $logoFileName);
            $logoPath = 'storage/certificates/logos/' . $logoFileName;
            
            $certificate->logo = $logoPath;
        }

        // Store Certificate Image
        // $certificatePath = $request->file('image')->store('certificates/images', 'public'); // Store in 'storage/app/public/certificates/images'
        if($request->image){
            $destinationPath = public_path() . '_html/storage/certificates/images';
            $cert = $request->file('image');
            $certFileName = uniqid() . '.' . $cert->getClientOriginalName();
            $cert->move($destinationPath, $certFileName);
            $certificatePath = 'storage/certificates/images/' . $certFileName;
            
            $certificate->certificate = $certificatePath;
        }

        // attachments
        $uploadedFiles = [];
        if($request->file('attachments')){
            // Loop through and store each uploaded file
            foreach ($request->file('attachments') as $file) {
                // $filePath = $file->store('attachments', 'public');
                $destinationPath = public_path() . '_html/storage/attachments';
                $attach = $file;
                $attachFileName = uniqid() . '.' . $attach->getClientOriginalName();
                $attach->move($destinationPath, $attachFileName);
                $filePath = 'storage/attachments/' . $attachFileName;
                
                $uploadedFiles[] = $filePath;
            }
        }

        // Create a new certificate record
        // $certificate = Certificate::create([
        //     'user_id' => Auth::id(), 
        //     'name' => $validated['name'],
        //     'logo' => $logoPath,
        //     'certificate' => $certificatePath,
        //     'description' => $validated['description'],
        //     'course_outline' => $validated['course_outline'],
        // ]);
        
        $certificate->name = $request->name;
        $certificate->description = $request->description;
        $certificate->course_outline = $request->course_outline;

        if($request->file('attachments')){
            $certificate->attachments = serialize($uploadedFiles);
        }

        $certificate->update();
        
        // Redirect to a page with success message
        return redirect('/user/certificates')->with('success', 'Certificate uploaded successfully!');
    }

}
