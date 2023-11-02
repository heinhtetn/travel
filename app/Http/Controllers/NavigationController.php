<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Poi;
use App\Models\Transportation;
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
        return view('navigation.detail', compact('poi'));
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
}
