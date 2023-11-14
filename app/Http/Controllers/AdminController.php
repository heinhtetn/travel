<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Poi;
use App\Models\Transportation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $counts = [
            'poi' => Poi::count(),
            'transportation' => Transportation::count(),
            'accomodation' => Accomodation::count(),
            'user' => User::where('is_admin', '0')->count(),
            'admin' => User::where('is_admin', '1')->count(),
            'vehicle' => Vehicle::count()
        ];
      
        return view('admin.dashboard', compact('counts'));
    }
}
