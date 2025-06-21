<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

// Define API routes here
// Define your API route
Route::post('/certificate_logo', [RegisterController::class, 'certificate_logo']);
