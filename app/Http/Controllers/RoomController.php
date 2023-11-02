<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Room;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class RoomController extends Controller
{
    
    public function index(Accomodation $accomodation)
    {

        $rooms = Room::where('accomodation_id', $accomodation->id)->get();

        $id = $accomodation->id;

        return view('admin.rooms.index', compact('rooms', 'id'));
    }

    public function create($accomodation_id)
    {
        return view('admin.rooms.create', compact('accomodation_id'));
    }

    public function store(Request $request, $accomodation_id)
    {
        $validated = $request->validate([
            'room_type' => 'required',
            'price' => 'required|numeric'
        ]);

        $image = $request->file('image');
        $originalFileName = $image->getClientOriginalName();
        $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('rooms'), $imageName);

        $validated['image'] = $imageName;
        $validated['accomodation_id'] = $accomodation_id;

        Room::create($validated);

        return redirect('admin/' . $accomodation_id . '/rooms')->with('create', 'Created Successfully');
    }

    public function edit($accomodation_id, Room $room)
    {
        return view('admin.rooms.edit', compact('accomodation_id', 'room'));
    }

    public function update(Request $request, $accomodation_id, Room $room)
    {
        $request->validate([
            'room_type' => 'required',
            'price' => 'required|numeric'
        ]);

        if($request->file('image'))
        {
            $image = $request->file('image');
            $originalFileName = $image->getClientOriginalName();
            $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('rooms'), $imageName);

            if (file_exists(public_path('rooms/' . $room->image))) {
                unlink(public_path('rooms/' . $room->image));
            }
            

            $room->image = $imageName;
        }

        $room->room_type = $request->room_type;
        $room->price = $request->price;
        $room->accomodation_id = $accomodation_id;

        $room->save();

        return redirect('admin/' . $accomodation_id . '/rooms')->with('update', 'Updated Successfully');

    }

    public function destroy($accomodation_id, $id)
    {
        $room = Room::findOrFail($id);

        $room->delete();

        return redirect('admin/' . $accomodation_id . '/rooms')->with('delete', 'Deleted Successfully');
    }
}
