<?php

namespace App\Http\Controllers;

use App\Models\Poi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PoiController extends Controller
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
            $poi = Poi::query();

            return DataTables::of($poi)

            ->editColumn('created_at', function($e) {
                return Carbon::parse($e->created_at)->format("F j, Y, g:i a");
            })
            
            ->addColumn('action', function($a) {

                $edit = '<a href=" '.route('poi.edit', $a->id).'" class="btn btn-sm btn-success" style="margin-right: 10px;">Edit</a>';
                $delete = '<a href="" class="deleteButton btn btn-sm btn-danger" data-id="'. $a->id .'">Delete</a>';

                return '<div class="action">' . $edit . $delete . '</div>';

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.poi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.poi.create');
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
            'interests' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'content' => 'required',
            'name' => 'required'
        ]);

        $poi = new Poi();
        $image = $request->file('image');
        $originalFileName = $image->getClientOriginalName();
        $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('poi'), $imageName);

        $poi->image = $imageName;
        $poi->location = $request->location;
        $poi->interests = $request->interests;
        $poi->name = $request->name;
        $poi->content = $request->content;

        $poi->save();

        return redirect('admin/poi')->with('create', 'Created Successfully');
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
    public function edit(Poi $poi)
    {
        return view('admin.poi.edit',compact('poi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poi $poi)
    {
        $request->validate([
            'interests' => 'required',
            'name' => 'required',
            'location' => 'required',
            'content' => 'required'
        ]);

        if($request->file('image'))
        {
            $image = $request->file('image');
            $originalFileName = $image->getClientOriginalName();
            $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('poi'), $imageName);

            if (file_exists(public_path('poi/' . $poi->image))) {
                unlink(public_path('poi/' . $poi->image));
            }
            

            $poi->image = $imageName;
        }

        
        $poi->location = $request->location;
        $poi->interests = $request->interests;
        $poi->name = $request->name;
        $poi->content = $request->content;

        $poi->save();

        return redirect('admin/poi')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poi = Poi::findOrFail($id);
        $poi->delete();

        return 'success';
    }
}
