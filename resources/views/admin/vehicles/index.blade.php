@extends('admin.master')

@section('transportation', 'nav-link active')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <a href="{{ route('transportation.index') }}" class="btn btn-sm btn-primary mb-4">
                    <i class="fa fa-chevron-left"></i>
                    Back
                </a>


                <a href="{{ route('vehicles.create', $id) }}" class="btn btn-sm btn-primary float-right mb-4">
                    <i class="fa fa-plus"></i>
                    Vehicles
                </a>


            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="content">
            <div class="container-fluid">
                <table class="table table-bordered table-hover" id="post">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Departure Place</th>
                            <th>Departure Time</th>
                            <th>Ticket Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->starting_point }}</td>
                                <td>{{ $vehicle->schedule }}</td>
                                <td>{{ $vehicle->ticket_price }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('vehicles.edit', ['transportation' => $id, 'vehicle' => $vehicle->id]) }}"
                                            class="btn btn-sm btn-success mr-3">
                                            Edit
                                        </a>
                                        <form id="deleteForm"
                                            action="{{ route('vehicles.destroy', ['transportation_id' => $id, 'id' => $vehicle->id]) }}"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                class="deleteButton btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('script')
    <script>
        var form = document.getElementById('deleteForm');
        var deleteButtons = document.querySelectorAll('.deleteButton');

        deleteButtons.forEach(function(deleteButton) {
            deleteButton.addEventListener('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Do you want to delete this vehicle?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>

@endsection
