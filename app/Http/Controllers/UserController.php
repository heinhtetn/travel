<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\AccomodationReview;
use App\Models\Destination;
use App\Models\Poi;
use App\Models\State;
use App\Models\Transportation;
use App\Models\TransportationReview;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $states = State::all();
        $destinations = Destination::all();

        return view('users.index', compact('states', 'destinations'));
    }

    public function show(Request $request)
    {
        
        
        $pois = Poi::where('location', $request->to)->get();
        $from = $request->from;

        return view('users.poi', compact('pois', 'from'));
    }

    public function detail($from ,Poi $poi)
    {
        $transportations = Transportation::where('from',$from)->where('to', $poi->location)->orderBy('name', 'asc')->get();
        $ratings = Accomodation::where('location', $poi->location)->distinct()->orderBy('rating', 'desc')->pluck('rating');


        return view('users.detail', compact('poi','transportations','ratings'));
    }

    public function show_transportation(Transportation $transportation)
    {
        $name = $transportation->name;
        $vehicles = $transportation->vehicles;
        $score = 0;
        $stars = [];
        foreach($vehicles as $vehicle)
        {
            if(count($vehicle->reviews) > 0)
            {
                for($i = 0; $i < count($vehicle->reviews); $i++)
                {
                    $score += $vehicle->reviews[$i]->rating;
                }
                $total = $score / count($vehicle->reviews);
                $score = 0;
                
                $stars[] = $total;
            }
        }
        
        return view('users.transportation', compact('vehicles', 'name', 'stars'));
        

    }

    public function show_accomodation($location, $rating)
    {
        
        $accomodations = Accomodation::where('location', $location)->where('rating',$rating)->get();

        return view('users.accomodation', compact('accomodations','rating'));

    }

    public function show_rooms($location, Accomodation $accomodation)
    {
        $rooms = $accomodation->rooms;
        return view('users.rooms', compact('rooms'));
    }

    public function vehicle_review(Vehicle $vehicle)
    {
        $reviews = TransportationReview::with('user')->where('vehicle_id', $vehicle->id)->paginate(3);

        return view('users.review', compact('vehicle', 'reviews'));
    }

    public function create_vehicle_review(Request $request, $id)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required'
        ]);

        $review = new TransportationReview();

        $review->vehicle_id = $id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = auth()->user()->id;

        $review->save();

        $transportation_id = Vehicle::where('id', $id)->get('transportation_id');
        $id_for_url = $transportation_id[0]->transportation_id;

        return redirect('user/transportation/' . $id_for_url);
    }

    public function accomodation_review($location, Accomodation $accomodation)
    {
        $reviews = AccomodationReview::with('user')->where('accomodation_id', $accomodation->id)->paginate(3);

        return view('users.accomodation_review', compact('reviews', 'accomodation'));
    }

    public function create_accomodation_review($location, Request $request, Accomodation $accomodation)
    {
        
        $request->validate([
            'review' => 'required',
            'rating' => 'required'
        ]);

        $review = new AccomodationReview();

        $review->accomodation_id = $accomodation->id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = auth()->user()->id;

        $review->save();

        $ratings = AccomodationReview::where('accomodation_id', $accomodation->id)->get('rating');
        $score = 0;
        foreach($ratings as $rating)
        {
            $score += $rating['rating'];
        }
        $result = $score / count($ratings);
        $decimalPart = $result - floor($result);
        if($decimalPart < 0.5)
        {
            $result = floor($result);
        }
        else
        {
            $result = ceil($result);
        }
        Accomodation::where('id', $accomodation->id)->update(['rating' => $result]);

        return redirect('user/accomodation/' . $location . '/' . $accomodation->id . '/review');
    }
}
