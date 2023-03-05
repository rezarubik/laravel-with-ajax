@extends('dashboard.layouts.master')
@section('css')
<!-- Custom styles for this page -->
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('title', 'Edit Roles Permission')
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
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Edit Role Permission
                </div>
                <div class="col-md-6">
                    <a href="{{route('dashboard.role.index')}}" type="button" class="btn btn-md btn-primary float-right">
                        <i class="fas fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form enctype='multipart/form-data' action="{{route('dashboard.role.update_permission', $role->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="role_name">Role</label>
                            <input id="role_name" type="text" class="form-control" readonly value="{{$role->name}}">
                            <!-- <small id="regionHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="role_name">Data Permissions</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="from[]" id="search" class="form-control" size="8" multiple="multiple">
                                        @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="button" id="search_rightAll" class="btn btn-secondary btn-sm btn-block"><i class="fas fa-forward"></i></button>
                                    <button type="button" id="search_rightSelected" class="btn btn-secondary btn-sm btn-block"><i class="fas fa-chevron-right"></i></button>
                                    <button type="button" id="search_leftSelected" class="btn btn-secondary btn-sm btn-block"><i class="fas fa-chevron-left"></i></button>
                                    <button type="button" id="search_leftAll" class="btn btn-secondary btn-sm btn-block"><i class="fas fa-backward"></i></button>
                                </div>

                                <div class="col-md-5">
                                    <select name="to[]" id="search_to" class="form-control" size="8" multiple="multiple">
                                        @foreach($role_permission as $nd)
                                        <option value="{{$nd->id}}">{{$nd->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="sidebar-divider d-none d-md-block">
                <button type="submit" class="btn btn-md btn-primary float-right">
                    <i class="fas fa-solid fa-save"></i> Update
                </button>
            </form>
        </div>
    </div>

</div>

<!-- Modal Create New -->


@endsection

@section('js')
<script src="{{asset('assets/js/crlcu_multiselect.min.js')}}"></script>
<script>
    $('document').ready(function() {
        $('#search').multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Selected Permission" />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search Permission" />',
            },
            fireSearch: function(value) {
                return value.length >= 3;
            }
        });


        $('.govisform').on('submit', function(event) {
            event.preventDefault();
            this.submit();
            // var checked = $('input[type=checkbox]:checked').length;
            // if(checked > 0 ){
            //     this.submit();
            // }else{
            //     swal({
            //         type: "error",
            //         title: "Delete Permission",
            //         text: "Please Select permission first before submitting",
            //         timer: 3000,
            //     });
            // }
        });
    });
</script>
@endsection