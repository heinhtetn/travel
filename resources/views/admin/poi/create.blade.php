@extends('admin.master')

@section('point_of_interest', 'nav-link active')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <a href="/admin/poi" class="btn btn-primary btn-sm float-right mb-4"><i class="fa fa-chevron-left"></i> Back</a>    

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="p-4 mt-5">
            <form action="{{route('poi.store')}}" method="POST" enctype="multipart/form-data" style="max-width: 800px; margin: auto">
                @csrf
                <h3 class="text-center mb-4">Add new interest</h3>
                <div class="row">
                  <div class="col-4">
                    <input type="text" name="interests" class="form-control mb-4" placeholder="Interest">
                  </div>
                  <div class="col-4">
                    <input type="text" name="name" class="form-control mb-4" placeholder="Name">
                  </div>
                  <div class="col-4">
                    <input type="text" name="location" class="form-control mb-4" placeholder="Location">
                  </div>
                </div>             
                <textarea class="form-control mb-3" placeholder="Write content for point of interest..." name="content" id="" cols="30" rows="10"></textarea>
                <button type="submit" class="btn btn btn-success float-right">Add</button>
                <input type="file" name="image">
            </form>
        </div>
        
      </div><!-- /.container-fluid -->
    </div> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
