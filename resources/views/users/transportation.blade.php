@extends('components.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Vehicles</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Vehicles</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">                
                <h1>{{ucwords($name)}} Lines</h1>
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Make a choice for {{$name}} schedule</h6>
            </div>
            
                
            <div class="row">
                @foreach($stars as $star)
                
                    <div class="col-lg-4 col-md-12 col-sm-12 pb-2">
                        <div class="star-rating d-flex justify-content-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="star {{ $i <= $star ? 'active' : '' }}"
                                    id="star{{ $i }}">
                                    <i class="fa fa-star" style="font-size: 25px"></i>
                                </div>
                            @endfor
                        </div>                   
                    </div>
                
                @endforeach
            </div>
            <div class="row">
                @foreach($vehicles  as $vehicle)
                
                    <div class="col-lg-4 col-md-12 col-sm-12 pb-2">
                        <div class="team-item bg-white mb-4">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{url('vehicles/' . $vehicle->image)}}" alt="">
                            </div>
                            <div class="text-start mx-5 py-4">
                                <h5 class="text-truncate mb-2">{{ucwords($vehicle->name)}}</h5>
                                <p class="mb-3">Departure Time : {{$vehicle->schedule}}</p>
                                <p class="mb-3">1 seat : {{$vehicle->ticket_price}} mmk</p>
                                <p class="mb-3"><i class="fa fa-phone"></i> 09 123 456 789</p>
                                <a href="{{route('review.vehicles', $vehicle->id)}}" class="btn btn-info">Rate & Review</a>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            </div>
                
                    
        </div>
    </div>
    <!-- Team End -->

@endsection