<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function locationList() {
        $data['headerTitle'] = 'Location List';
        $data['locations'] = Location::latest()->get();

        return view('backend.admin.locations.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Location';

        return view('backend.admin.locations.add', $data);
    }

    public function insert(Request $request) {
        $request->validate([
            'location_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $location = new Location;
        $location->location_name = $request->location_name;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

        return redirect('location/list')->with("success", "Location successfully added.");
    }

    public function edit($id) {
        $data['location'] = Location::find($id);

        if(!empty($data['location'])) {
            $data['headerTitle'] = 'Edit Location';

            return view('backend.admin.locations.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'location_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $location = Location::find($request->location_id);
        $location->location_name = $request->location_name;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

        return redirect('location/list')->with("success", "Location successfully updated.");
    }

    public function delete($id) {
        $location = Location::find($id);
    
        if (!empty($location)) {
            $location->delete();
            
            return redirect('location/list')->with("success", "Location successfully deleted.");
        } else {
            abort(404);
        }
    }

}
