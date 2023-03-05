@extends('dashboard.layouts.master')
@section('title', 'Create User')
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
                            <h1 class="h3 mb-2 text-gray-800 m-0">Create New</h1>
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
                    <form enctype='multipart/form-data' action="{{route('dashboard.user.store')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="region">Role</label>
                                    <select multiple name="id_role[]" id="id_role" class="form-control selectpicker @error('id_role') is-invalid  @enderror" data-live-search="true" data-style="btn-light">
                                        @foreach($roles as $role)
                                        <option value="{{$role->name}}" {{(collect(old('id_role'))->contains($role->id)) ? 'selected' : ''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_role')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid  @enderror" placeholder="Enter firstname here" name="firstname" value="{{old('firstname')}}">
                                    @error('firstname')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid  @enderror" placeholder="Enter lastname here" name="lastname" value="{{old('lastname')}}">
                                    @error('lastname')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid  @enderror" placeholder="Enter email here" name="email" value="{{old('email')}}" autocomplete="off">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Enter password here" name="password" value="" autocomplete="off">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirm">Confirmation Password</label>
                                    <input id="confirm" type="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Enter confirm password here" name="confirm" value="">
                                    @error('confirm')
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

<!-- //todo javascript -->
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    function replaceChars(entry) {
        temp = "" + entry; // temporary holder
        document.getElementById('descriptionHidden').value = (temp);
    }

    var description = document.getElementById("description");

    CKEDITOR.replace(description, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;

    function upload() {
        $("#image").click();
    }

    // todo remove image
    function remove() {
        $('#image').replaceWith(selected_photo = $('#image').clone(true));
        $('#preview_img').attr('src', `{{URL::asset('placeholder.png')}}`);
        $('#oldImage_1').val('');
    }

    async function preview_image(input) {
        if (input.files[0].size > 5000000) {
            swal({
                title: "Oops!",
                text: "Maximum size is 5MB",
                icon: "error",
            });
            return;
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        } else {
            console.log('kosong');
        }
    }
</script>
@endsection

@section('js')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection