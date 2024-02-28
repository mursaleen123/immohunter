<?php

use App\Http\Controllers\PropertyController;
use App\Models\BrandModel;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Brand Routes
|--------------------------------------------------------------------------
*/

Route::controller(PropertyController::class)->group(function () {
    Route::get('properties', 'index')->name('property');
    Route::view('add_property', 'backend.property.property_add', ['data' => DB::table('users')->where('role', '=', 'vendor')->get()])->name('property-add');
    Route::post('create_property', 'propertyCreate')->name('property-create');
    // Route::get('remove_brand/{id}', 'brandRemove')->name('brand-remove')->whereNumber('id');
    // Route::post('update_brand', 'brandUpdate')->name('brand-update');

    Route::post('assign-property', function (Request $request) {
        $property = Property::where('id', $request->property_id)->first();
        if ($property) {
            $property->update(['user_id' => $request->user_id]);
            return response(['msg' => 'Property is assigned successfully.'], 200);
        } else {
            return response(['error' => 'Property not found.'], 404);
        }
    })->name('assign-property');

    Route::post('/update-property-status/{id}', 'updateStatus')->name('update.property.status');
});
