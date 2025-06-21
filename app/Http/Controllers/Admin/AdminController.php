<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

// QR
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Intervention\Image\Decoders\Base64ImageDecoder;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\Typography\FontFactory;

use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{




    public function index()
    {
        $certificate_count = Certificate::count();
        
        $colleges_count = User::role('user')->count();
        $employers_count = User::role('employer')->count();
        
        // $details = [
        //     'title' => 'Test Email from Laravel',
        //     'body' => 'This is a test email sent using Gmail SMTP in Laravel.'
        // ];
    
        // Mail::send('emails.mail_code', $details, function ($message) {
        //     $message->to('luisluistun@gmail.com')
        //             ->subject('Test Email');
        // });
        
        return view('admin.admin_index', compact('certificate_count', 'colleges_count', 'employers_count'));
    }
    
    public function users()
    {
        $colleges = User::role('user')->get();
        $employers = User::role('employer')->get();
        
        return view('admin.admin_users', compact('colleges', 'employers'));
    }
    
    public function userApprove($id){
        $user = User::find($id);
        
        $user->approved = 1;
        
        $user->update();
        
        return redirect()->back()->with('success', "$user->name has been approved.");
    }
    
    public function userCreate(){
        return view('admin.admin_user_create');
    }
    
    public function register(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('employer');

        $user->email_verified_at = Carbon::now();
        $user->approved = 1;
        $user->save();

        return redirect('/admin/users')->with('success', "$user->name has been successfully created.");
    }
    
    public function registerUni(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'reg_number' => $validated['reg_number'],
            'contact_name' => $validated['contact_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('user');
        
        $user->email_verified_at = Carbon::now();
        $user->approved = 1;
        $user->save();

        return redirect('/admin/users')->with('success', "$user->name has been successfully created.");
    }
    
    public function userEdit($id){
        $user = User::find($id);
        $college = $user->hasRole("user") ? true : false;
        
        return view('admin.admin_user_edit', compact('user', 'college'));
    }
    
    public function userUpdate(Request $request){
        $user = User::find($request->id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ($request->email == $user->email) ? '' : 'required|string|email|max:255|unique:users',
            'password' =>  $request->password ? 'required|string|min:8|confirmed' : '',
        ]);
        
        $user->name = $validated['name'];
        if($request->email != $user->email){
            $user->email = $validated['email'];
            $user->email_verified_at = Carbon::now();
        }
        if($request->password){
            $user->password = Hash::make($validated['password']);
        }
        
        $user->update();
        
        return redirect('/admin/users')->with('success', "$user->name has been successfully updated.");
    }
    
    public function userUpdateUni(Request $request){
        $user = User::find($request->id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => ($request->email == $user->email) ? '' : 'required|string|email|max:255|unique:users',
            'password' =>  $request->password ? 'required|string|min:8|confirmed' : '',
        ]);
        
        $user->name = $validated['name'];
        $user->reg_number = $validated['reg_number'];
        $user->contact_name = $validated['contact_name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        if($request->email != $user->email){
            $user->email = $validated['email'];
            $user->email_verified_at = Carbon::now();
        }
        if($request->password){
            $user->password = Hash::make($validated['password']);
        }
        
        $user->update();
        
        return redirect('/admin/users')->with('success', "$user->name has been successfully updated.");
    }
    
    public function userLimit($id){
        $user = User::find($id);
        
        return view('admin.admin_user_limit', compact('user'));
    }
    
    public function userLimitUpdate(Request $request){
        $user = User::find($request->id);
        
        $validated = $request->validate([
            'cert_limit' => 'required',
        ]);
        
        $user->cert_limit = $validated['cert_limit'];
        
        $user->update();
        
        return redirect('/admin/users')->with('success', "$user->name's certificate limit has been updated.");
    }

    public function certificates()
    {
        Auth::user()->certificates = Certificate::all();
        
        return view('admin.certificates');
    }

    // public function addCertificate()
    // {
    //     return view('admin.add_certificate');
    // }

    // public function uploadCertificate(Request $request){
    //     // Validate form input
    //     $validated = $request->validate([
    //         'name' => 'required|string',
    //         'logo' => 'required|image|mimes:png|max:10240', // Validate image
    //         'image' => 'required|image|mimes:png|max:10240', // Validate certificate image
    //         'description' => 'required|string|max:1000',
    //         // 'attachments' => 'required|array', // Ensure attachments is an array
    //         // 'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048', // Validate each file in the array
    //     ]);

    //     // Store Logo
    //     // $logoPath = $request->file('logo')->store('certificates/logos', 'public'); // Store in 'storage/app/public/certificates/logos'
    //     $destinationPath = public_path() . '_html/storage/certificates/logos';
    //     $logo = $request->file('logo');
    //     $logoFileName = uniqid() . '.' . $logo->getClientOriginalName();
    //     $logo->move($destinationPath, $logoFileName);
    //     $logoPath = 'storage/certificates/logos/' . $logoFileName;

    //     // Store Certificate Image
    //     // $certificatePath = $request->file('image')->store('certificates/images', 'public'); // Store in 'storage/app/public/certificates/images'
    //     $destinationPath = public_path() . '_html/storage/certificates/images';
    //     $cert = $request->file('image');
    //     $certFileName = uniqid() . '.' . $cert->getClientOriginalName();
    //     $cert->move($destinationPath, $certFileName);
    //     $certificatePath = 'storage/certificates/images/' . $certFileName;

    //     // attachments
    //     $uploadedFiles = [];
    //     if($request->file('attachments')){
    //         // Loop through and store each uploaded file
    //         foreach ($request->file('attachments') as $file) {
    //             // $filePath = $file->store('attachments', 'public');
    //             $destinationPath = public_path() . '_html/storage/attachments';
    //             $attach = $file;
    //             $attachFileName = uniqid() . '.' . $attach->getClientOriginalName();
    //             $attach->move($destinationPath, $attachFileName);
    //             $filePath = 'storage/attachments/' . $attachFileName;
                
    //             $uploadedFiles[] = $filePath;
    //         }
    //     }

    //     // Create a new certificate record
    //     $certificate = Certificate::create([
    //         'user_id' => Auth::id(), // Assuming you are storing user ID
    //         'name' => $validated['name'],
    //         'logo' => $logoPath,
    //         'certificate' => $certificatePath,
    //         'description' => $validated['description'],
    //     ]);

    //     if($request->file('attachments')){
    //         $certificate->attachments = serialize($uploadedFiles);
    //         $certificate->update();
    //     }

    //     // Redirect to a page with success message
    //     return redirect('/user/certificates')->with('success', 'Certificate uploaded successfully!');
    // }

    public function createQR($id){
        $certificate = Certificate::find($id);

        // Generate QR Code
        $qrcodeFileName = $certificate->uniqueId . '.png'; // Generate unique file name for the QR code
        $qrcodePath = public_path() . '_html/storage/certificates/qrcodes/' . $qrcodeFileName;

        // Generate the QR Code (assuming SimpleQRCode is installed)
        // $address = "http://localhost/checkqr/$certificate->uniqueId";
        $address = "http://mmcertify.com/check-certificate/$certificate->uniqueId";

        QrCode::errorCorrection('H')->format('png')->size(300)->generate( $address , $qrcodePath);


        $manager = ImageManager::imagick();

        // same call with configuration options
        $manager = ImageManager::imagick(blendingColor: 'fff000');
        // $filePath = public_path('images/test.png'); // Set the path where the file will be saved
        $filePath = $qrcodePath;

        $image = $manager->read($filePath);

        $image->pad(300, 350, position: 'top');

        $image->text($certificate->uniqueId, $image->width() / 2, $image->height(), function (FontFactory $font) {
            $font->filename('./fonts/Roboto-Medium.ttf');
            $font->size(50);
            $font->color('000');
            // $font->stroke('ff5500', 2);
            $font->align('center');
            // $font->valign('middle');
            // $font->lineHeight(1.6);
            // $font->angle(10);
            $font->valign("botttom");
            // $font->wrap(250);
        });

        // result will be in gif format
        $encoded = $image->encodeByMediaType('image/png');

        // encode jpeg as png and save in a new file
        // $image->save('images/example.png');
        $image->save($qrcodePath);

        $certificate->qrcode = 'storage/certificates/qrcodes/' . $qrcodeFileName;
        $certificate->generated = 1;
        $certificate->update();

        return redirect()->back()->with('success', 'QR & Id has been generated');
    }

    public function certificateDetail($id){
        $certificate = Certificate::find($id);

        return view('admin.certificate_detail', compact('certificate'));
    }

}
