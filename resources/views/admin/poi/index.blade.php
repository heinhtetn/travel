@extends('admin.master')

@section('point_of_interest', 'nav-link active')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <a href="/admin/poi/create" class="btn btn-primary float-right mb-4"><i class="fa fa-plus"></i> new
                interest</a>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-hover" id="post">
                <thead>
                    <tr>
                        <th>Interests</th>
                        <th>Name</th>
                        <th>Created at</th>
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
            url: '/admin/poi/',
            error: function(xhr, testStatus, errorThrown) {

            }
        },

        "columns": [{
                "data": "interests"
            },
            {
                "data": "name"
            },
            {
                "data": "created_at"
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
            title: 'Do you want to delete this point of interest?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/poi/' + id,
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

