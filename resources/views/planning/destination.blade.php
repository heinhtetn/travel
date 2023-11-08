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
            <h1>Choose your destination</h1>
            
        </div>
        <div class="row">
            @foreach($destinations as $destination)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div  class="destination-item position-relative overflow-hidden mb-2">
                        @if($destination->name == 'ShanEast')
                            <img class="img-fluid"  src="{{asset('img/ShanEast.jpg')}}" alt="">
                        @elseif($destination->name == 'ShanNorth')
                            <img class="img-fluid"  src="{{asset('img/ShanNorth.jpg')}}" alt="">
                        @else
                            <img class="img-fluid"  src="{{asset('img/ShanSouth.jpg')}}" alt="">
                        @endif
                        
                        <a class="destination-overlay text-white text-decoration-none" href="{{route('plan.choose', ['from' => $from, 'to' => $destination->name])}}">
                            <h5 class="text-white">{{$destination->name}}</h5>
                        </a>
                    </div>
                </div> 
            @endforeach
        </div>
    </div>
</div>
<!-- Destination Start -->
@endsection
