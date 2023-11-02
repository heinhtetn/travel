@extends('admin.master')

@section('point_of_interest', 'nav-link active')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <a href="/admin/poi" class="btn btn-primary float-right mb-4"><i class="fa fa-chevron-left"></i> Back</a>    

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="p-5 mt-5">
            <form action="{{route('poi.update', $poi->id)}}" enctype="multipart/form-data" method="POST" style="max-width: 800px; margin:auto">
                @method('PUT')
                @csrf
                <h3 class="text-center mb-4">Edit point of interest</h3>
                <div class="row">
                  <div class="col-4">
                    <input type="text" name="interests" value="{{$poi->interests}}" class="form-control mb-4" placeholder="Interest">
                  </div>
                  <div class="col-4">
                    <input type="text" name="name" value="{{$poi->name}}" class="form-control mb-4" placeholder="Name">
                  </div>
                  <div class="col-4">
                    <input type="text" name="location" value="{{$poi->location}}" class="form-control mb-4" placeholder="Location">
                  </div>
                </div>           
                <textarea class="form-control mb-4" name="content" id="" cols="30" rows="10">{{$poi->content}}</textarea>
                <input type="file" name="image">
                <button type="submit" class="btn btn btn-success float-right">Save</button>
            </form>
        </div>
        
      </div><!-- /.container-fluid -->
    </div> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection