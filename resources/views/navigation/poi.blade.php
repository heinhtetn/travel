@extends('components.master')

@section('poi', 'nav-link active')

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
            <h3 class="display-4 text-white text-uppercase">Point of Interests</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Point of Interests</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->



<!-- Destination Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h1>Point of Interests</h1>
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Explore Top Interesting Places</h6>
            
        </div>
        <div class="row">
            @foreach($pois as $poi)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div  class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" style="height: 220px;width: 350px" src="{{url('poi/' . $poi->image)}}" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="{{route('poi.detail', $poi->id)}}">
                            <h5 class="text-white">{{$poi->name}}</h5>
                            <span>{{$poi->interests}}</span>
                        </a>
                    </div>
                </div> 
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{$pois->links()}}
        </div>
        
    </div>
</div>
<!-- Destination Start -->
@endsection
