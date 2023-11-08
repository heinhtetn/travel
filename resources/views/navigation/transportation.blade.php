@extends('components.master')

@section('transport', 'nav-link active')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Transportations</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Transportations</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->



    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h1>Transportations</h1>
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Travel with comfortable transportation
                    services</h6>

            </div>
            <div class="row">
                @foreach ($transports as $transport)
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 18rem; height: 23rem">
                            <img class="card-img-top" style="height: 180px" src="{{ url('transportation/' . $transport->image) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title mb-3">{{ ucwords($transport->name) }}</h5>
                                <h6 class="card-text mb-3">{{ $transport->departure_time }}</h6>
                                <h6 class="card-text mb-3">{{ ucwords($transport->from) }} to {{ucwords($transport->to)}}</h6>
                                <a href="{{route('transport.detail', $transport->id)}}" class="btn btn-primary">Check Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{$transports->links()}}
            </div>

        </div>
    </div>
    <!-- Destination Start -->
@endsection
