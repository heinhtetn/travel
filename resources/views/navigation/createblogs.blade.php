@extends('components.master')

@section('blogs', 'nav-link active')

@section('content')
<div class="mt-5 row">
<div class="col-lg-8" style="margin: auto">
    <div class="bg-white mb-3" style="padding: 30px;">
        <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">create a blog</h4>
        <form action="{{route('blogs.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="title" name="title" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="tag">Tag *</label>
                <input type="tag" name="tag" class="form-control" id="tag">
            </div>
    
            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="image" id="image">
            </div>
            <div class="form-group mb-0">
                <input type="submit" value="Post"
                    class="btn btn-primary font-weight-semi-bold py-2 px-3">
            </div>
        </form>
    </div>
</div>

</div>

<!-- Comment Form End -->
@endsection