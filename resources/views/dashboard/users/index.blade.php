@extends('dashboard.layouts.master')
@section('title', 'List Users')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="{{ asset('assets/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
@endsection
@section('content')
<div class="container-fluid">
    @if(Session::has('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Viola!</strong> {{Session::get('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> {{Session::get('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-2 text-gray-800 m-0">Management Users</h1>
                </div>
                <!-- //todo: Create new data here -->
                <div class="col-md-6">
                    <a type="button" class="btn btn-md btn-primary float-right" href="{{route('dashboard.user.create')}}">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="users_table" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Photos</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('dashboard.users.modal_delete')

<!-- //note: JS -->
<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    var table = $('#users_table').DataTable({
        order: [],
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: "{{ route('dashboard.user.index_data') }}",
        },
        'dataType': 'json',
        'paging': true,
        'lengthChange': true,
        'columns': [{
                data: 'firstname',
                name: 'firstname'
            },
            {
                data: 'lastname',
                name: 'lastname'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    })

    // todo: direct to edit data user
    function editData(id) {
        let url = "{{url('dashboard/users/edit')}}" + '/' + id;
        window.location.href = url;
    }

    // todo: Show modal delete
    function showModalDelete(id) {
        $('#modalDelete').modal('show');
        $('#id_user').val(id);
    }

    // todo: action delete user
    function deleteData() {
        $('#modalDelete').modal('show');
        let id_user = $('#id_user').val();
        if (id_user) {
            $('#modalDelete').modal('hide');
            $.ajax({
                url: "{{url('dashboard/users/delete')}}" + '/' + id_user,
                type: "POST",
                data: {
                    '_token': '{{csrf_token()}}'
                },
                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        title: 'Delete User',
                        text: response.message,
                        timer: 3000,
                        showCancelButton: false,
                    })
                    table.ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        type: 'error',
                        title: 'Login Gagal!',
                        text: response.message
                    });
                }
            });
        }
    }
</script>
@endsection