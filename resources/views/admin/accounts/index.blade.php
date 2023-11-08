@extends('admin.master')

@section('users', 'nav-link active')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="content">
            <div class="container-fluid">
                {{-- <table class="table table-bordered table-hover" id="post">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form id="promoteForm"
                                            action="{{ route('promote.user', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="promoteButton btn btn-sm btn-success">Promote</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        <div>
                            {{$users->links()}}
                        </div>

                    </tbody>
                </table> --}}
                <table class="table table-bordered table-hover" id="post">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
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
            url: '/admin/user_accounts/',
            error: function(xhr, testStatus, errorThrown) {

            }
        },

        "columns": [{
                "data": "name"
            },
            {
                "data": "email"
            },
            {
                "data": "created_at"
            },
            {
                "data": "action"
            }
        ]
    });
    $(document).on('click', '.promoteButton', function(a) {
        a.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Do you want to promote this user to admin?',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/user_accounts/promote/' + id,
                    type: 'POST',
                    success: function(response) {
                        console.log(response);
                        if(response.message == 'User promoted to admin.')
                        {
                            table.ajax.reload();
                        }
                        else
                        {
                            return 'error';
                        }
                    }
                });
            }
        })
    });
</script>

@endsection
