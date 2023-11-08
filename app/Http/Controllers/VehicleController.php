<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Transportation $transportation)
    {

        $vehicles = $transportation->vehicles;
        $id = $transportation->id;

        return view('admin.vehicles.index', compact('vehicles', 'id'));
        
    }
    
    public function create($id)
    {
        return view('admin.vehicles.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'starting_point' => 'required',
            'ticket_price' => 'required|numeric',
            'schedule' => 'required'
        ]);

        $image = $request->file('image');
        $originalFileName = $image->getClientOriginalName();
        $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('vehicles'), $imageName);

        $validated['image'] = $imageName;

        $validated['transportation_id'] = $id;

        Vehicle::create($validated);

        return redirect('admin/'. $id .'/vehicles')->with('create' , 'Created Successfully');
    }

    public function edit(Transportation $transportation, Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('transportation', 'vehicle'));
    }

    public function update(Request $request, Transportation $transportation, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required',
            'starting_point' => 'required',
            'ticket_price' => 'required|numeric',
            'schedule' => 'required'
        ]);

        if($request->file('image'))
        {
            $image = $request->file('image');
            $originalFileName = $image->getClientOriginalName();
            $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('vehicles'), $imageName);

            if (file_exists(public_path('vehicles/' . $vehicle->image))) {
                unlink(public_path('vehicles/' . $vehicle->image));
            }
            

            $vehicle->image = $imageName;
        }

        $id = $transportation->id;

        $vehicle->name = $request->name;
        $vehicle->starting_point = $request->starting_point;
        $vehicle->ticket_price = $request->ticket_price;

        $vehicle->save();

        return redirect('admin/'. $id .'/vehicles')->with('update', 'Updated Successfully');    

    }   

    public function destroy($transportation_id, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        $vehicle->delete();

        return redirect('admin/' . $transportation_id . '/vehicles')->with('delete', 'Deleted Successfully');
    }
}
