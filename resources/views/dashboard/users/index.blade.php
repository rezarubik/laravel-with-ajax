@extends('dashboard.layouts.master')
@section('title', 'List Users')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <form action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter search here.." name="search" value="{{request('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                @if($users->count())
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Is Verify</th>
                        <th>Registered On</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->firstname}}</td>
                            <td>{{$user->lastname}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->roles->count())
                                <ul>
                                    @foreach($user->roles as $role_user)
                                    <li>
                                        {{$role_user->name}}
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="text-danger">Haven't role</p>
                                @endif
                            </td>
                            <td>{{$user->is_verify}}</td>
                            <td>{{$user->created_at}}</td>
                            <td class="text-center">
                                <a title="Detail" class="btn btn-warning btn-circle btn-sm" href="{{route('dashboard.user.edit', $user->id)}}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{route('dashboard.user.destroy', $user->id)}}" method="post">
                                    <button title="Delete" type="button" data-toggle="modal" data-target="#deleteUser{{$user->id}}" data-id="{{$user->id}}" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- //start Modal Delete -->
                        <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" role="document" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form enctype='multipart/form-data' action="{{route('dashboard.user.destroy', $user->id)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete User {{$user->firstname}} {{$user->lastname}} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p>Are you sure want to delete user {{$user->firstname}} {{$user->lastname}}?</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- //end Modal Delete -->
                        @endforeach
                    </tbody>
                </table>
                @else
                <table class="table table-bordered rolesTable" id="rolesTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <p class="text-center text-danger">Data not found</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
                <select name="" id="">
                    @for($x = 1; $x <= $users->total(); $x++)
                    <option value="">{{$x}}</option>
                    @endfor
                </select>
                <div class="d-flex justify-content-end">
                    {{ $users->links() }}
                </div>
                <div class="d-flex justify-content-left">
                    Current Page: {{ $users->currentPage() }}
                </div>
                <div class="d-flex justify-content-left">
                    Total Data: {{ $users->total() }}
                </div>
                <div class="d-flex justify-content-left">
                    Per Page: {{ $users->perPage() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<!-- <script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script> -->

<!-- <script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "aaSorting": [
                [6, "desc"]
            ]
        });
    });
</script> -->
@endsection