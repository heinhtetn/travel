@extends('admin.master')

@section('transportation', 'nav-link active')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <a href="/admin/transportation" class="btn btn-primary float-right mb-4"><i class="fa fa-chevron-left"></i> Back</a>    

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <form action="{{route('transportation.store')}}" enctype="multipart/form-data" method="POST" class="border border-rounded shadow-xl p-4 mt-5">
                @csrf
                <h3 class="text-center mb-4">Add new transportation</h3>
                <input type="text" name="name" class="form-control mb-4" placeholder="Name">
                <input type="text" name="departure_time" class="form-control mb-4" placeholder="Departure time">
                <select class="form-control mb-4" name="from" id="">
                    <option value="">--From---</option>
                    <option value="yangon">Yangon</option>
                    <option value="mandalay">Mandalay</option>
                </select>
                <select class="form-control mb-4" name="to" id="">
                    <option value="">--To---</option>
                    <option value="shan(east)">Shan (East)</option>
                    <option value="shan(south)">Shan (South)</option>
                    <option value="shan(north)">Shan (North)</option>
                    <option value="kayah">Kayah</option>
                </select>
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
