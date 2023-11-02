@extends('admin.master')

@section('transportation', 'nav-link active')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <a href="{{route('vehicles.index', $id)}}" class="btn btn-primary btn-sm float-right mb-4"><i class="fa fa-chevron-left"></i> Back</a>    

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <form action="{{route('vehicles.store', $id)}}" enctype="multipart/form-data" method="POST" class="border border-rounded shadow-xl p-4 mt-5">
                @csrf
                <h3 class="text-center mb-4">Add new vehicle</h3>
                <input type="text" name="name" class="form-control mb-4" placeholder="Name">
                <input type="text" name="starting_point" class="form-control mb-4" placeholder="Departure place">
                <input type="number" name="ticket_price" class="form-control mb-4" placeholder="Ticket Price">
                <input type="text" name="schedule" class="form-control mb-4" placeholder="Departure Time">
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
