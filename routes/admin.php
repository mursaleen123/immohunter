<?php

use App\Http\Controllers\User\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'auth.role:admin'])
    ->prefix('admin')
    ->name('admin-')
    ->controller(AdminController::class)->group(function () {

        // vendors
        Route::view(
            'vendors',
            'backend.admin.all_vendors',
            ['data' => User::where('role', '=', 'vendor')->get()]
        )->name('vendor-list');

        Route::get('/create/vendor', function () {
            return view('backend.admin.admin_add');
        })->name('create-vendor');

        Route::post('/add/vendor', [AdminController::class, 'storeVendor'])->name('save-vendor');

        Route::post('activate_vendor', 'vendorActivate')->name('activate-vendor');
        Route::post('remove_vendor', 'userRemove')->name('vendor-remove');


        // fallback
        Route::fallback(function () {
            return redirect('/admin/dashboard');
        })->name('brand-fallback');
    });
