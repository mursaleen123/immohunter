<?php

namespace App\Http\Controllers;

use App\Http\Requests\propertyRequest;
use App\Mail\PropertyAssigned;
use App\Models\Property;
use App\Models\propertyModel;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{

    public function propertyCreate(Request $request)
    {

        $data =  $request->except(['_token']);
        $user = User::where('id', $data['user_id'])->first();
        if (Property::insert($data)) {
            Mail::to($user->email)->send(new PropertyAssigned($user));

            return redirect()->back()->with('success', 'Property Added Successfully');
        } else {
        }
        return redirect('property')->with('error', 'Failed to add this property, try again.');
    }

    public function propertyRemove(Request $request)
    {
        try {
            $property = Property::findOrFail($request->id);
            MyHelpers::deleteImageFromStorage($property->property_image, 'uploads/images/property/');
            if ($property->delete())
                return redirect()->route('property')->with('success', 'Successfully removed.');
            else
                return redirect('propertys')->with('error', 'Failed to remove this property.');
        } catch (ModelNotFoundException $exception) {
            return redirect('propertys')->with('error', 'Failed to remove this property.');
        }
    }

    /**
     * @param propertyRequest $request
     */
    public function propertyUpdate(Request $request)
    {
        // validation
        $data = $request->validated();

        // get the current property ( which being updated )
        try {
            $property = Property::findOrFail($request->get('property_id'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin-property')->with('error', 'Something went wrong, try again.');
        }

        // handling if the request has an image
        $newImage = $request->file('property_image');
        if ($newImage) {
            $data['property_image'] = $this->handleRequestImage($request->file('property_image'), 'uploads/images/property');
            MyHelpers::deleteImageFromStorage($property->property_image, 'uploads/images/property/');
        }

        // update
        $data['property_slug'] = $this->getpropertySlug($data['property_name']);
        if ($property->update($data))
            return response(['msg' => 'property is updated successfully.'], 200);
        else
            return redirect()->route('admin-property')->with('error', 'Something went wrong, try again.');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $properties = Property::all();
        } elseif ($user->role === 'vendor') {
            $properties = Property::where('user_id', $user->id)->get();
        }

        $vendors = DB::table('users')->where('role', '=', 'vendor')->get();

        return view('backend.property.property_list', [
            'data' => $properties,
            'users' => $vendors,
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        $property = Property::where('id', $id)->update(['status' => $request->status]);
        // $property->status = $request->status;
        // $property->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
