<?php

use App\Http\Controllers\PropertyController;
use App\Models\BrandModel;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Brand Routes
|--------------------------------------------------------------------------
*/

Route::controller(PropertyController::class)->group(function () {
    Route::view('properties', 'backend.property.property_list', ['data' => Property::all()])->name('property');
    Route::view('add_property', 'backend.property.property_add', ['data' => DB::table('users')->where('role', '=', 'vendor')->get()])->name('property-add');
    Route::post('create_property', 'propertyCreate')->name('property-create');
    // Route::get('remove_brand/{id}', 'brandRemove')->name('brand-remove')->whereNumber('id');
    // Route::post('update_brand', 'brandUpdate')->name('brand-update');
});
