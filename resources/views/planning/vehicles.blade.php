@extends('components.master')

@section('planning', 'nav-link active')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Planning</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Planning</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->



    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                @if(session('room_fee'))
                    <form action="{{route('plan.summary', ['from' => $from, 'to' => $to])}}" id="submit-form" method="POST">
                    @method('GET')
                @else
                    <form action="{{route('hotel.plan', ['from' => $from, 'to' => $to])}}" method="POST">
                @endif
                
                    @csrf
                    <div class="container-fluid booking mt-5 pb-5">
                        <div class="container pb-5">
                            <div class="bg-light shadow" style="padding: 30px;">
                                <div class="row align-items-center" style="min-height: 60px;">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 mb-md-0">
                                                    <input class="form-control" placeholder="VehicleName*" type="text" name="name" id="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 mb-md-0">
                                                    <input class="form-control" placeholder="SeatCount*" type="number" name="count" id="">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        @if(session('room_fee'))
                                            <button class="btn btn-primary btn-block" id="submit-button" type="submit"
                                            style="height: 47px; margin-top: -2px;">Submit</button>
                                        @else
                                            <button class="btn btn-primary btn-block" type="submit"
                                            style="height: 47px; margin-top: -2px;">Submit</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <h1 class="mb-5">Choose your vehicle</h1>

            </div>
            <div class="row">
                @foreach ($vehicles as $vehicle)
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 18rem; height: 22rem">
                            <img class="card-img-top" style="height: 180px" src="{{ url('vehicles/' . $vehicle->image) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title mb-3">{{ ucwords($vehicle->name) }}</h5>
                                <h6 class="card-text mb-3">Stop - {{ ucwords($vehicle->starting_point) }}</h6>
                                <h6 class="card-text mb-3">{{ $vehicle->ticket_price }} mmk per seat</h6>
                                <h6 class="card-text mb-3">Depart at {{ $vehicle->schedule }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Destination Start -->
@endsection

@section('script')
    <script>
        var form = document.getElementById('submit-form');
        var button = document.getElementById('submit-button');

    
        button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure about your trip plan?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

    </script>
@endsection
