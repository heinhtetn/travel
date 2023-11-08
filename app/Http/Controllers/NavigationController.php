<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Blog;
use App\Models\Poi;
use App\Models\Transportation;
use Illuminate\Foundation\Console\ViewClearCommand;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    //
    public function index()
    {
        $pois = Poi::paginate(3);

        return view('navigation.poi', compact('pois'));
    }

    public function detail(Poi $poi)
    {
        $blogs = Blog::where('tag', $poi->name)->get();
        
        return view('navigation.detail', compact('poi', 'blogs'));
    }

    public function show_transportation()
    {
        $transports = Transportation::paginate(3);

        return view('navigation.transportation', compact('transports'));
    }

    public function detail_transportation(Transportation $transportation)
    {
        $details = $transportation->vehicles;

        return view('navigation.vehicle', compact('details'));
    }

    public function show_hotels()
    {
        $hotels = Accomodation::all();

        return view('navigation.hotels', compact('hotels'));
    }

    public function show_rooms(Accomodation $accomodation)
    {
        $rooms = $accomodation->rooms;

        return view('navigation.rooms', compact('rooms'));
    }

    public function show_blogs()
    {

        $blogs = Blog::orderBy('created_at', 'desc')->paginate(4);

        return view('navigation.blogs', compact('blogs'));
    }

    public function new_blog()
    {

        return view('navigation.createblogs');
    }

    public function create_blog(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'tag' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $image = $request->file('image');
        $originalFileName = $image->getClientOriginalName();
        $imageName = $originalFileName . "_" . time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('blogs'), $imageName);

        $validated['image'] = $imageName;
        $validated['user_id'] = auth()->user()->id;

        

        Blog::create($validated);

        return redirect('user/blogs');
    }

    public function blog_detail(Blog $blog)
    {
        return view('navigation.blogs-detail', compact('blog'));
    }

    public function search(Request $request)
    {
        $blogs = Blog::where('content', 'LIKE', '%' . $request->keyword . '%')->orWhere('title', 'LIKE', '%' . $request->keyword . '%')->paginate(4);
                    
        return view('navigation.blogs', compact('blogs'));
        
    }

    public function show_contact()
    {
        return view('navigation.contact');
    }
}
