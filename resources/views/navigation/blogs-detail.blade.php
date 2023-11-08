@extends('components.master')

@section('blogs', 'nav-link active')

@section('content')
    
        <!-- Header Start -->
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">{{ucwords($blog->tag)}}</h3>
                </div>
            </div>
        </div>
        <!-- Header End -->
    
    
        <!-- Blog Start -->
        <div class="container-fluid">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Blog Detail Start -->
                        <div class="pb-3">
                            <div class="blog-item">
                                <div class="position-relative">
                                    <img class="img-fluid w-100" src="{{url('blogs/' . $blog->image)}}" alt="">
                                    {{-- <div class="blog-date">
                                        <h6 class="font-weight-bold mb-n1">01</h6>
                                        <small class="text-white text-uppercase">Jan</small>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="bg-white mb-3" style="padding: 30px;">
                                <div class="d-flex mb-3">
                                    <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                    <span class="text-primary px-2">|</span>
                                    <a class="text-primary text-uppercase text-decoration-none" href="">Tours & Travel</a>
                                </div>
                                <div class="d-flex">
                                    <h2 class="mb-3 mr-3">{{ucwords($blog->title)}},</h2> 
                                    <h5 class="mb-3 pt-2">{{ucwords($blog->tag)}}</h5>
                                </div>
                                
                                <p style="text-align: justify">{{$blog->content}}</p>
                                
                                
                        </div>
                        <!-- Blog Detail End -->
        
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->
@endsection