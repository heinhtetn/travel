<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Destination;
use App\Models\Room;
use App\Models\State;
use App\Models\Transportation;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PlanningnController extends Controller
{
    //
    public function index()
    {

        $states = State::all();

        return view('planning.index', compact('states'));
    }

    public function destination($from)
    {
        $destinations = Destination::all();

        return view('planning.destination', compact('destinations', 'from'));
    }

    public function choose($from, $to, Request $request)
    {
        return view('planning.choose', compact('from', 'to'));
         
    }

    public function transport(Request $request,$from, $to)
    {
        if($request->isMethod('GET'))
        {
            $transports = Transportation::where('from', $from)->where('to', $to)->get();

            return view('planning.transportation', compact('transports', 'from', 'to'));
        }
        elseif($request->isMethod('POST'))
        {
            $request->validate([
                'room_type' => 'required',
                'count' => 'required|numeric'
            ]);

            $price = Room::where('room_type', $request->room_type)->get('price');

            $total = $price[0]->price * $request->count;

            Session::put('room_fee', $total);
            Session::put('room_type', $request->room_type);
            Session::put('night_count', $request->count);

            $transports = Transportation::where('from', $from)->where('to', $to)->get();

            return view('planning.transportation', compact('transports', 'from', 'to'));
        }
        
    }

    public function vehicle($from, $to, Transportation $transportation)
    {
        Session::put('transportation', $transportation->name);
        $vehicles = $transportation->vehicles;
        return view('planning.vehicles', compact('vehicles', 'from', 'to'));
    }

    public function accomodation(Request $request, $from, $to)
    {
        if($request->isMethod('GET'))
        {
            $hotels = Accomodation::where('location', $to)->get();

            return view('planning.accomodation', compact('hotels', 'from', 'to'));
        }
        elseif($request->isMethod('POST'))
        {
            $request->validate([    
                'name' => 'required',
                'count' => 'required|numeric'
            ]);
            $vehicle = Vehicle::where('name', $request->name)->get();
            $total = $vehicle[0]->ticket_price * $request->count;
    
            Session::put('transport_fee', $total);
            Session::put('vehicle', $vehicle);
            Session::put('seat_count', $request->count);
            $hotels = Accomodation::where('location', $to)->get();
    
            return view('planning.accomodation', compact('hotels', 'from', 'to'));
        }
       

    }

    public function room($from, $to, Accomodation $accomodation)
    {
        Session::put('accomodation', $accomodation);

        $rooms = $accomodation->rooms;

        return view('planning.rooms', compact('rooms', 'from', 'to'));
    }

    public function summary(Request $request, $from, $to)
    {
        if(session()->has('transport_fee'))
        {
            $price = Room::where('room_type', $request->room_type)->get('price');

            $total = $price[0]->price * $request->count;
            
            $transport_fee = Session::get('transport_fee');

            $plan = [
                'cost' => $total + $transport_fee,
                'seat_count' => Session::get('seat_count'),
                'transportation' => Session::get('transportation'),
                'room_type' => $request->room_type,
                'night_count' => $request->count
            ];

            $vehicle = Session::get('vehicle');


            $accomodation = Session::get('accomodation');

            session()->forget(['transport_fee']);

            return view('planning.final', compact('plan', 'vehicle', 'accomodation', 'from', 'to'));
        }
        elseif(session()->has('room_fee'))
        {
            $vehicle = Vehicle::where('name', $request->name)->get();

            $total = $vehicle[0]->ticket_price * $request->count;

            $room_fee = Session::get('room_fee');

            $plan = [
                'cost' => $total + $room_fee,
                'seat_count' => $request->count,
                'transportation' => Session::get('transportation'),
                'room_type' => Session::get('room_type'),
                'night_count' => Session::get('night_count')
            ];

            $accomodation = Session::get('accomodation');

            session()->forget('room_fee');

            return view('planning.final', compact('plan', 'vehicle', 'accomodation', 'from', 'to'));

        }
        
    }
}
