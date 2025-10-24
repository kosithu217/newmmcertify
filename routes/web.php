<?php

use Illuminate\Support\Facades\Route;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Intervention\Image\Decoders\Base64ImageDecoder;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\Typography\FontFactory;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Spatie\Permission\Models\Role;
use App\Models\Blog;
use App\Models\Certificate;
use App\Models\Profile;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/blog', [HomeController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/api-docs', function () {
    return view('api_docs');
})->name('api-docs');
// Route::get('/home', function () {
//     return view('home');
// })->name('home');

Route::get('/home', function () {
    $blogs = Blog::with('images')
               ->latest()
               ->take(3) 
               ->get();
    
    return view('home', ['blogs' => $blogs]);
})->name('home');

// Blog post public view - Using ID instead of slug
Route::get('/home1', function () {
    return view('home1');
})->name('home1');
Route::get('/terms-and-conditions', function () {
    return view('terms_and_conditions');
})->name('tnc');
Route::get('/check', function () {
    return view('check');
})->name('check');

// Route::get('/check-certificate/{id}', function($id){
//     use App\Models\Profile;
//     $certificate = Certificate::where('uniqueId', $id)->first();
//     if(!$certificate){
//         return redirect('/')->with('error', 'Certificate not found!');
//     }

//     return view('check_certificate', compact('certificate'));
// });
Route::get('/check-certificate/{id}', function($id) {
    $certificate = Certificate::where('uniqueId', $id)->first();
    
    if(!$certificate) {
        return redirect('/')->with('error', 'Certificate not found!');
    }

    // Get the profile associated with the certificate's user_id
    $profile = Profile::where('user_id', $certificate->user_id)->first();
    
    return view('check_certificate', [
        'certificate' => $certificate,
        'profile' => $profile
    ]);
});

Route::post('/search', function(Request $request){
    $certificate = Certificate::where('uniqueId', $request->number)->where('name', $request->name)->first();
    
    if(!$certificate){
        return redirect()->back()->with('error', '<h2 class="text-danger">Invalid.</h3><br><p>We could not find your search in our database. Please contact MM Certify directly for assistance, either through the certificate issuer or the certificate holder.</p><br><br>');
    }

    return redirect("/check-certificate/".$request->number);
});


// Route::post('/test-api', [RegisterController::class, 'testApi']);

Route::post('/upload-certificate-logo', [RegisterController::class, 'uploadCertificateLogo'])->name('uploadCertificateLogo');
 
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/register1', [RegisterController::class, 'showRegistrationForm1'])->name('register1');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/register-uni', [RegisterController::class, 'registerUni'])->name('register-uni');
Route::get('/reset-password', [RegisterController::class, 'resetPassword'])->name('reset');
Route::post('/reset-password', [RegisterController::class, 'resetPasswordSubmit'])->name('reset-password');
Route::get('/reset-password/{id}/{c}', [RegisterController::class, 'verifyReset'])->name('verifyReset');
Route::post('/update-password', [RegisterController::class, 'updatePassword'])->name('update-password');

Route::get('/verify/{id}/{c}', [RegisterController::class, 'verify'])->name('verify');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/contact', [LoginController::class, 'contactSubmitForm'])->name('contact.submit');

Route::middleware(['user-group'])->prefix('user')->group(function () {
    // Profile CRUD routes
Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile'); // List all profiles
Route::get('/profile/create', [ProfileController::class, 'create'])->name('user.profile.create'); // Show create form
Route::post('/profile', [ProfileController::class, 'store'])->name('user.profile.store'); // Store new profile
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('user.profile.show'); // Show single profile
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('user.profile.edit'); // Show edit form
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('user.profile.update'); // Update profile
Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('user.profile.destroy'); // Delete profile
  


    
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/certificates', [UserController::class, 'certificates'])->name('user.certificates');
    Route::get('/certificates/detail/{id}', [UserController::class, 'certificateDetail'])->name('user.certificate_detail');
    Route::get('/certificate/create', [UserController::class, 'addCertificate'])->name('user.addCertificate');
    Route::get('/certificate/{id}/edit', [UserController::class, 'editCertificate'])->name('user.editCertificate');
    Route::post('/certificate/update', [UserController::class, 'updateCertificate'])->name('user.updateCertificate');
    Route::post('/certificate/upload', [UserController::class, 'uploadCertificate'])->name('user.uploadCertificate');
    Route::post('/certificate/qr/{id}', [UserController::class, 'createQR'])->name('user.createQR');
});


Route::middleware(['admin-group'])->prefix('admin')->group(function () {
    // Dashboard
    Route::middleware(['menu.permission:dashboard'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    });
    
    // Blog Routes
    Route::middleware(['menu.permission:blog'])->group(function () {
        Route::get('/blog/test', [BlogController::class, 'test'])->name('admin.blog.test');
        Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
        Route::post('/blog', [BlogController::class, 'store'])->name('admin.blog.store');
        Route::delete('/blog/image/{id}', [BlogController::class, 'deleteImage'])->name('admin.blog.delete-image');
        Route::post('/blog/upload-image', [BlogController::class, 'uploadImage'])->name('admin.blog.upload-image');
        Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.delete');
    });
    
    // User Management Routes
    Route::middleware(['menu.permission:users'])->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/user/{id}/approve', [AdminController::class, 'userApprove'])->name('admin.userApprove');
        Route::get('/user/create', [AdminController::class, 'userCreate'])->name('admin.userCreate');
        Route::post('/register', [AdminController::class, 'register'])->name('admin-register');
        Route::post('/register-uni', [AdminController::class, 'registerUni'])->name('admin-register-uni');
        Route::get('/user/{id}/edit', [AdminController::class, 'userEdit'])->name('admin.userEdit');
        Route::post('/user/update', [AdminController::class, 'userUpdate'])->name('admin.userUpdate');
        Route::post('/user/updateUni', [AdminController::class, 'userUpdateUni'])->name('admin.userUpdateUni');
        Route::get('/user/{id}/limit', [AdminController::class, 'userLimit'])->name('admin.userLimit');
        Route::post('/user/limit-update', [AdminController::class, 'userLimitUpdate'])->name('admin.userLimitUpdate');
    });
    
    // Certificate Routes
    Route::middleware(['menu.permission:certificates'])->group(function () {
        Route::get('/certificates', [AdminController::class, 'certificates'])->name('admin.certificates');
        Route::post('/certificate/qr/{id}', [AdminController::class, 'createQR'])->name('admin.createQR');
        Route::get('/certificates/detail/{id}', [AdminController::class, 'certificateDetail'])->name('admin.certificate_detail');
    });
    
    // Admin Management Routes
    Route::middleware(['menu.permission:admin_management'])->group(function () {
        Route::get('/admin-management', [AdminController::class, 'adminManagement'])->name('admin.admin-management');
        Route::get('/admin-management/create', [AdminController::class, 'createAdmin'])->name('admin.create-admin');
        Route::post('/admin-management', [AdminController::class, 'storeAdmin'])->name('admin.store-admin');
        Route::get('/admin-management/{id}/edit', [AdminController::class, 'editAdmin'])->name('admin.edit-admin');
        Route::put('/admin-management/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update-admin');
        Route::delete('/admin-management/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.delete-admin');
    });
});


