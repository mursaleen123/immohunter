<?php

use App\Http\Controllers\User\VendorController;
use App\Mail\SetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| vendor Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'auth.role:vendor'])
    ->prefix('vendor')
    ->name('vendor-')
    ->controller(VendorController::class)->group(function () {

        // profile
        Route::view('profile', 'backend.profile.vendor_profile')->name('profile');
        Route::post('profile/update_info', 'updateInfo')->name('profile-info-update');
        Route::post('profile/update_image', 'updateImage')->name('profile-image-update');
        Route::post('profile/update_password', 'updatePassword')->name('profile-password-update');

        // fallback
        Route::fallback(function () {
            return redirect('/vendor/profile');
        })->name('brand-fallback');
    });


Route::post('resend/set_password', function (Request $request) {
    $user = User::where('id', $request->user_id)->first();
    // Send email to the vendor
    Mail::to($user->email)->send(new SetPasswordEmail($user->email));

    return redirect()->back()->with('success', 'Email Sent Successfully');
})->name('resend-vendor-email');
