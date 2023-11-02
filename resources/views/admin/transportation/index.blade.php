@extends('admin.master')

@section('transportation', 'nav-link active')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <a href="/admin/transportation/create" class="btn btn-primary btn-sm float-right mb-4"><i class="fa fa-plus"></i>
                Transportation</a>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-hover" id="post">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Departure Time</th>
                        <th>From</th>
                        <th>To</th>
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
            url: '/admin/transportation/',
            error: function(xhr, testStatus, errorThrown) {

            }
        },

        "columns": [{
                "data": "name"
            },
            {
                "data": "departure_time"
            },
            {
                "data": "from"
            },
            {
                "data": "to"
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
            title: 'Do you want to delete this transportation?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/transportation/' + id,
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

