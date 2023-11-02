@extends('admin.master')

@section('accomodation', 'nav-link active')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <a href="{{route('accomodations.create')}}" class="btn btn-primary float-right mb-4"><i class="fa fa-plus"></i>
                accomodation</a>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-hover" id="post">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>


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
    var table = $('#post').DataTable({
        'serverSide': true,
        'processing': true,
        'ajax': {
            url: '/admin/accomodations/',
            error: function(xhr, testStatus, errorThrown) {

            }
        },

        "columns": [{
                "data": "name"
            },
            {
                "data": "type"
            },
            {
                "data": "location"
            },
            {
                "data": "action"
            }
        ]
    });


    $(document).on('click', '.deleteButton', function(a) {
        a.preventDefault();
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Do you want to delete this accomodation?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/accomodations/' + id,
                    type: 'DELETE',
                    success: function() {
                        table.ajax.reload();
                    }
                });
            }
        })
    });
</script>
@endsection

