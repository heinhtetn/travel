@extends('components.master')

@section('blogs', 'nav-link active')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Blog</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Blog</p>
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
                    <div class="row pb-3">
                        @foreach ($blogs as $blog)
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="blog-item">
                                    <div class="position-relative">
                                        <img class="img-fluid w-100" style="width: 350px; height: 250px;"
                                            src="{{ url('blogs/' . $blog->image) }}" alt="">
                                    </div>
                                    <div class="bg-white p-4">
                                        <div class="d-flex mb-2">
                                            <a class="text-primary text-uppercase text-decoration-none"
                                                href="">Admin</a>
                                            <span class="text-primary px-2">|</span>
                                            <a class="text-primary text-uppercase text-decoration-none" href="">Tours
                                                & Travel</a>
                                        </div>
                                        <a class="h5 m-0 text-decoration-none"
                                            href="{{route('blogs.detail', $blog->id)}}">{{ ucwords($blog->title) }}</a>
                                        <p class="mt-2">{{ $blog->created_at->format('F j, Y, g:i a') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">

                    <!-- Search Form -->
                    <div class="mb-5">
                        <form  id="searchForm" action="{{route('blogs.search')}}" method="POST">
                            @csrf
                            <div class="bg-white" style="padding: 30px;">
                                <div class="input-group">
                                    <input type="text" name="keyword" id="searchInput" class="form-control p-4" placeholder="Keyword">
                                    <div class="input-group-append">

                                        <span class="input-group-text bg-primary border-primary text-white">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search text-dark"></i>
                                            </button>
                                                
                                            
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <a href="{{ route('blogs.new') }}" class="btn btn-primary float-right p-2">Write a post?</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <div class="d-flex justify-content-center">
        {{ $blogs->links() }};
    </div>
@endsection


{{-- @section('script')
    <script>
        const form = document.getElementById('searchForm');
        const input = document.getElementById('searchInput');


        form.addEventListner('submit', (event) => {
            event.preventDefault();

            const searchValue = input.value;

            form.action = `/user/blogs/search?search=${searchValue}`;


            form.submit();
        })
    </script>
@endsection --}}
