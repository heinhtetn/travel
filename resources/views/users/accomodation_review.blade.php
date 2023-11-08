@extends('components.master')

@section('content')

    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Hotel Review</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">hotel Review</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h1>Leave A Review</h1>
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">You can honestly describe what you
                    think!</h6>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="bg-white mb-3" style="padding: 30px;">
                        {{-- <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Leave a review</h4> --}}
                        <form action="{{route('review.make', ['location' => $accomodation->location,'accomodation' =>$accomodation->id])}}" id="reviewForm" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="review" cols="30" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="rate">
                                <input type="radio" id="star5" class="rate-label" name="rating"
                                    value="5" />
                                <label for="star5" title="5star">5 stars</label>
                                <input type="radio" id="star4" class="rate-label" name="rating"
                                    value="4" />
                                <label for="star4" title="4star">4 stars</label>
                                <input type="radio" id="star3" class="rate-label" name="rating"
                                    value="3" />
                                <label for="star3" title="3star">3 stars</label>
                                <input type="radio" id="star2" class="rate-label" name="rating"
                                    value="2" />
                                <label for="star2" title="2star">2 stars</label>
                                <input type="radio" id="star1" class="rate-label" name="rating"
                                    value="1" />
                                <label for="star1" title="1star">1 star</label>
                            </div>


                            <div class="d-block form-group mb-0">
                                <button class="btn btn-primary font-weight-semi-bold py-2 px-3"
                                    type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white" style="padding: 30px; margin-bottom: 30px;">
                        <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">{{ count($reviews) }} Comments</h4>

                        @foreach ($reviews as $review)
                            <div class="media mb-4">
                                
                                <div class="media-body">
                                    <h6><a href="">{{$review->user->name}}</a>
                                        <small><i>{{ $review->created_at->format('F j, Y, g:i a') }}</i></small>
                                    </h6>
                                    <p>{{ $review->review }}</p>
                                    <div class="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="star {{ $i <= $review->rating ? 'active' : '' }}"
                                                id="star{{ $i }}-{{ $review->id }}">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$reviews->links()}}

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Team End -->
@endsection
