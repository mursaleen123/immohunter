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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif', // Validate each image
            'user_id' => 'required|exists:users,id'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $imageName = time() . '_' . $image->getClientOriginalName();
                // $image->storeAs('public/images', $imageName);
                // $images[] = 'storage/app/public/images/' . $imageName;
                $images[] = MyHelpers::uploadImage($image, 'uploads/images/properties');

            }
        }
        $property = new Property();
        $property->title = $request->title;
        $property->location = $request->location;
        $property->price = $request->price;
        $property->description = $request->description;
        $property->property_link = $request->property_link;
        $property->status = $request->status;
        $property->images = json_encode($images); // Serialize the array
        $property->user_id = $request->user_id;
        $property->save();

        $user = User::find($request->user_id);
        Mail::to($user->email)->send(new PropertyAssigned($user));

        return redirect()->back()->with('success', 'Property Added Successfully');
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
            $properties = Property::orderByDesc('id')->get();
        } elseif ($user->role === 'vendor') {
            $properties = Property::where('user_id', $user->id)->orderByDesc('id')->get();
        }

        $vendors = DB::table('users')->where('role', '=', 'vendor')->get();

        return view('backend.property.property_list', [
            'data' => $properties,
            'users' => $vendors,
        ]);
    }

    public function getPropertyByStatus($status)
    {
        $user = Auth::user();
        $validStatuses = ['all','new', 'in-contact', 'pending', 'accepted', 'completed', 'sold'];

        if (!in_array($status, $validStatuses)) {
            abort(404); // or handle invalid status as per your application's logic
        }

        $vendors = DB::table('users')->where('role', '=', 'vendor')->get();
        if($status === 'all'){
            if ($user->role === 'admin') {
                $properties = Property::orderByDesc('id')->get();
            } elseif ($user->role === 'vendor') {
                $properties = Property::where('user_id', $user->id)->orderByDesc('id')->get();
            }
            return view('backend.property.property_list', [
                'data' => $properties,
                'users' => $vendors,
            ]);
        }

        if ($user->role === 'admin') {
            $properties = Property::where('status', $status)->orderByDesc('id')->get();
        } elseif ($user->role === 'vendor') {
            $properties = Property::where('user_id', $user->id)->where('status', $status)->orderByDesc('id')->get();
        }

        // $properties = Property::where('status', $status)->get();

        // You can return these properties to a view to display them
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
