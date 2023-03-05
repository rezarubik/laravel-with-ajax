@extends('dashboard.layouts.master')
@section('css')
<!-- Custom styles for this page -->
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('title', 'Roles')
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
                    <h1 class="h3 mb-2 text-gray-800 m-0">Management Roles</h1>
                </div>
                <div class="col-md-6">
                    <a type="button" class="btn btn-md btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
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
                @if($roles->count())
                <table class="table table-bordered rolesTable" id="rolesTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{date('D, F j, Y H:i:s', strtotime($role->created_at))}}</td>
                            <td class="text-center">
                                <button title="Edit" type="button" data-toggle="modal" data-target="#editRole{{$role->id}}" data-id="{{$role->id}}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <a title="Edit Permission" href="{{route('dashboard.role.edit_permission', $role->id)}}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-lock"></i>
                                </a>
                                <button title="Delete" type="button" data-toggle="modal" data-target="#deleteRole{{$role->id}}" data-id="{{$role->id}}" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- //start Modal Edit -->
                        <div class="modal fade" id="editRole{{$role->id}}" tabindex="-1" role="document" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form enctype='multipart/form-data' action="{{route('dashboard.role.update', $role->id)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Role {{$role->name}} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nameRegion">Name</label>
                                                <input required type="text" name="name" class="form-control" id="nameRegion" placeholder="Enter role here" value="{{$role->name}}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- //end Modal Edit -->

                        <!-- //start Modal Delete -->
                        <div class="modal fade" id="deleteRole{{$role->id}}" tabindex="-1" role="document" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form enctype='multipart/form-data' action="{{route('dashboard.role.delete', $role->id)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete role {{$role->name}} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p>Are you sure want to delete role {{$role->name}}?</p>
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

                <div class="d-flex justify-content-end">
                    {{ $roles->links() }}
                </div>
                <div class="d-flex justify-content-left">
                    Current Page: {{ $roles->currentPage() }}
                </div>
                <div class="d-flex justify-content-left">
                    Total Data: {{ $roles->total() }}
                </div>
                <div class="d-flex justify-content-left">
                    Per Page: {{ $roles->perPage() }}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Create New -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form enctype='multipart/form-data' action="{{route('dashboard.role.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input required type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter name here">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
@endsection