@extends('dashboard.layouts.master')
@section('title', 'Edit User')
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
    <!-- //start: detail user -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- //note: Header -->
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="h3 mb-2 text-gray-800 m-0">Edit User</h1>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('dashboard.user.index')}}" type="button" class="btn btn-md btn-primary float-right">
                                <i class="fas fa-solid fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <!-- //note: Body -->
                <div class="card-body">
                    <form enctype='multipart/form-data' action="{{route('dashboard.user.update', $user->id)}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12">

                                <label for="region">Roles</label>
                                <select multiple name="id_role[]" id="roles" class="form-control selectpicker" data-live-search="true" data-style="btn-light">
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}" {{collect($id_roles)->contains($role->id) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <!-- <small id="regionHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid  @enderror" placeholder="Enter firstname here" name="firstname" value="{{$user->firstname}}">
                                    @error('firstname')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid  @enderror" placeholder="Enter lastname here" name="lastname" value="{{ $user->lastname }}">
                                    @error('lastname')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid  @enderror" placeholder="Enter email here" name="email" value="{{$user->email}}" autocomplete="off">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="sidebar-divider d-none d-md-block">
                        <button type="submit" class="btn btn-md btn-primary float-right">
                            <i class="fas fa-solid fa-save"></i> Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //end: detail user -->

    <!-- //start: detail address -->

    <!-- //end: detail address -->

</div>

@endsection

@section('js')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection