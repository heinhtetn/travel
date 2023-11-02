<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $transport = Transportation::query();

            return DataTables::of($transport)

            ->addColumn('action', function($a) {
                
                
                $detail = '<a href=" '.route('vehicles.index', ['transportation_id' => $a->id]).'" class="btn btn-info btn-sm" style="margin-right: 10px;">Details</a>';
                $edit = '<a href=" '.route('transportation.edit', $a->id).'" class="btn btn-success btn-sm" style="margin-right: 10px;">Edit</a>';
                $add = '<a href=" '.route('vehicles.create', ['transportation_id' => $a->id]).'" class="btn btn-secondary btn-sm" style="margin-right: 10px;">Add</a>';

                return '<div class="action">' . $detail . $edit . $add . '</div>';

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.transportation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transportation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'departure_time' => 'required',
            'from' => 'required',
            'to' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $transport = new Transportation();

        $image = $request->file('image');
        $originalFileName = $image->getClientOriginalName();
        $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('transportation'), $imageName);

        $transport->image = $imageName;
        $transport->name = $request->name;
        $transport->departure_time = $request->departure_time;
        $transport->from = $request->from;
        $transport->to = $request->to;

        $transport->save();

        return redirect('admin/transportation')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportation $transportation)
    {
        return view('admin.transportation.edit', compact('transportation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Transportation $transportation)
    {
        $request->validate([
            'name' => 'required',
            'departure_time' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);

        if($request->file('image'))
        {
            $image = $request->file('image');
            $originalFileName = $image->getClientOriginalName();
            $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('transportation'), $imageName);

            if (file_exists(public_path('transportation/' . $transportation->image))) {
                unlink(public_path('transportation/' . $transportation->image));
            }

            $transportation->image = $imageName;
    
        }

        $transportation->name = $request->name;
        $transportation->departure_time = $request->departure_time;
        $transportation->from = $request->from;
        $transportation->to = $request->to;

        $transportation->save();

        return redirect('admin/transportation')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
