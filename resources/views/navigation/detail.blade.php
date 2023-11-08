@extends('components.master')

@section('content')
    
        <!-- Header Start -->
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">About {{$poi->name}}</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">{{ucwords($poi->name)}}</p>
                    </div>
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
                                    <img class="img-fluid w-100" src="{{url('poi/' . $poi->image)}}" alt="">
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
                                <h2 class="mb-3">Why you should visit this place?</h2>
                                <p style="text-align: justify">{{$poi->content}}</p>
                                
                                
                        </div>
                        <!-- Blog Detail End -->
        
                    </div>
        
                    <div class="col-lg-4 mt-5 mt-lg-0">
        
                        <!-- Recent Post -->
                        @if(count($blogs) > 0)
                            <div class="mb-5">
                                <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Recent Blogs</h4>
                                @foreach ($blogs as $blog)
                                <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="{{route('blogs.detail', $blog->id)}}">
                                    <img class="img-fluid" style="width: 130px" src="{{asset('img/blog.png')}}" alt="">
                                    <div class="pl-3">
                                        <h6 class="m-1">{{$blog->title}}</h6>
                                        <small>{{$blog->created_at->format('F j, Y, g:i a')}}</small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        @endif

        
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->
@endsection