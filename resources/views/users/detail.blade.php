@extends('components.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">About {{ $poi->name }}</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">{{ ucwords($poi->name) }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="pb-3">
                        <div class="blog-item">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="{{ url('poi/' . $poi->image) }}" alt="">

                            </div>
                        </div>
                        <div class="bg-white mb-3" style="padding: 30px;">
                            <div class="d-flex mb-3">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Tours &
                                    Travel</a>
                            </div>
                            <h2 class="mb-3">Why you should visit this place?</h2>
                            <p style="text-align: justify">{{ $poi->content }}</p>

                        </div>
                    </div>
                    <!-- Blog Detail End -->
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">

                    <!-- Recent Post -->
                    <div class="mb-5">
                        <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Transportation</h4>
                        @foreach ($transportations as $transport)
                            <a class="d-flex align-items-center text-decoration-none bg-white mb-3"
                                href="{{ route('show.transport', $transport->id) }}">
                                <img class="img-fluid" style="width: 200px"
                                    src="{{ url('transportation/' . $transport->image) }}" alt="">
                                <div class="pl-3">
                                    <h6 class="m-1">{{ ucwords($transport->name) }}</h6>
                                    <p style="font-size: 13px">{{ $transport->departure_time }}</p>
                                </div>

                            </a>
                        @endforeach
                    </div>
                    <div class="mb-5">
                        <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Accomodation</h4>
                        @foreach ($ratings as $rating)
                            <a class="d-flex align-items-center text-decoration-none bg-white mb-3"
                                href="{{ route('show.accomodation', ['location' => $poi->location, 'rating' => $rating]) }}">
                                <img class="img-fluid" style="width: 200px" src="{{ asset('img/hotel1.png') }}"
                                    alt="">
                                <div class="pl-3">
                                    <h6 class="m-1">{{ $rating }} star hotels</h6>
                                </div>

                            </a>
                        @endforeach

                    </div>

                </div>

                <!-- Tag Cloud -->

            </div>
        </div>
    </div>
    </div>
    <!-- Blog End -->
@endsection
