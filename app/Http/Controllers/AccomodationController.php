<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccomodationController extends Controller
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
            $poi = Accomodation::query();

            return DataTables::of($poi)

            ->editColumn('created_at', function($e) {
                return Carbon::parse($e->created_at)->format("F j, Y, g:i a");
            })
            
            ->addColumn('action', function($a) {

                $detail = '<a href=" '.route('rooms.index', ['accomodation' => $a->id]).'" class="btn btn-info btn-sm" style="margin-right: 10px;">Details</a>';
                $edit = '<a href=" '.route('accomodations.edit', $a->id).'" class="btn btn-success btn-sm" style="margin-right: 10px;">Edit</a>';
                $delete = '<a href="" class="deleteButton btn btn-danger btn-sm" data-id="'. $a->id .'">Delete</a>';

                return '<div class="action">' . $detail . $edit . $delete . '</div>';

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.accomodations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accomodations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:accomodations,name',
            'type' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'rating' => 'required|numeric'
        ]);

        $image = $request->file('image');
        $originalFileName = $image->getClientOriginalName();
        $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('accomodations'), $imageName);

        $validated['image'] = $imageName;

        Accomodation::create($validated);

        return redirect('admin/accomodations')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Accomodation $accomodation)
    {
        return view('admin.accomodations.edit', compact('accomodation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accomodation $accomodation)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
        ]);

        if($request->file('image'))
        {
            $image = $request->file('image');
            $originalFileName = $image->getClientOriginalName();
            $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('accomodations'), $imageName);

            if (file_exists(public_path('accomodations/' . $accomodation->image))) {
                unlink(public_path('accomodations/' . $accomodation->image));
            }
            
            $accomodation->image = $imageName;
        }

        $accomodation->name = $request->name;
        $accomodation->type = $request->type;
        $accomodation->location = $request->location;

        $accomodation->save();

        return redirect('admin/accomodations')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accomodation = Accomodation::findOrFail($id);

        $accomodation->delete();

        return 'success';
    }
}
