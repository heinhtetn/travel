@extends('admin.master')

@section('accomodation', 'nav-link active')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <a href="{{route('accomodations.index', $accomodation_id)}}" class="btn btn-primary btn-sm float-right mb-4"><i class="fa fa-chevron-left"></i> Back</a>     

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <form action="{{route('rooms.update',['accomodation_id' => $accomodation_id, 'room' => $room->id])}}" method="POST" enctype="multipart/form-data" class="border border-rounded shadow-xl p-4 mt-5">
                @csrf
                <h3 class="text-center mb-4">Edit Room</h3>
                <input type="text" name="room_type" value="{{$room->room_type}}" class="form-control mb-4" placeholder="Room Type">
                <input type="text" name="price" value="{{$room->price}}" class="form-control mb-4" placeholder="Room Price">
                <input type="file" name="image">
                <button type="submit" class="btn btn-sm btn-success float-right">Save</button>
            </form>
        </div>
        
      </div><!-- /.container-fluid -->
    </div> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection