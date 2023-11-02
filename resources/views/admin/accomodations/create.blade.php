@extends('admin.master')

@section('accomodations', 'nav-link active')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <a href="{{route('accomodations.index')}}" class="btn btn-sm btn-primary float-right mb-4"><i class="fa fa-chevron-left"></i> Back</a>    

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <form action="{{route('accomodations.store')}}" enctype="multipart/form-data" method="POST" class="border border-rounded shadow-xl p-4 mt-5">
                @csrf
                <h3 class="text-center mb-4">Add new accomodation</h3>
                <input type="text" name="name" class="form-control mb-4" placeholder="Name">
                <input type="text" name="type" class="form-control mb-4" placeholder="Type">
                <input type="text" name="location" class="form-control mb-4" placeholder="Location">
                <input type="number" name="rating" class="form-control mb-4" placeholder="Rating">
                <input type="file" name="image">
                <button type="submit" class="btn btn-sm btn-success float-right">Add</button>
            </form>
        </div>
        
      </div><!-- /.container-fluid -->
    </div> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
