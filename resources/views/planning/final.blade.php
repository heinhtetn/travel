@extends('components.master')

@section('planning', 'nav-link active')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Your trip plan</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Your trip plan</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->



    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <h1 class="text-center mb-5">Your Trip Plan Summary</h1>
        <div class="border" style="max-width: 370px; margin: auto">
            <div class="p-5">
                
                <ul style="list-style: none">
                    <li class="mb-3">
                        <span style="font-weight: bold">Trip</span> : From {{ $from }} To {{ $to }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Transportation</span> : {{ ucwords($plan['transportation']) }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Vehicle</span> : {{ ucwords($vehicle[0]->name) }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Departing place</span> : {{ ucwords($vehicle[0]->starting_point) }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Deaparture time</span>: {{ $vehicle[0]->schedule }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Seat count</span> : {{ $plan['seat_count'] }} seat
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Accomodation</span> : {{ ucwords($accomodation->name) }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Room type</span> : {{ ucwords($plan['room_type']) }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Night count</span> : {{ $plan['night_count'] }}
                    </li>
                    <li class="mb-3">
                        <span style="font-weight: bold">Total budget</span> : {{ $plan['cost'] }} mmk
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!-- Destination Start -->
@endsection
