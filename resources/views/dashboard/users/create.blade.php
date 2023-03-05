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
                <div class="card-body" id="formStoreUser">
                    <form action="#" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
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
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input id="foto" type="file" class="form-control upload-photo" name="foto" accept="image/jpeg, image/jpg, image/png">
                                </div>
                                <div class="form-group">
                                    <label for="preview">Preview Foto</label>
                                    <div class="preview-photo">
                                        <img src="{{asset('assets/img/img-preview.svg')}}" class="preview-image" alt="" width="200px" height="200px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="sidebar-divider d-none d-md-block">
                    <button href="#" id="create_user" class="btn btn-md btn-primary float-right">
                        <i class="fas fa-solid fa-save"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- //end: detail user -->

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<!-- //todo javascript -->
<script type="text/javascript">
    $('#create_user').click(function(error) {
        error.preventDefault();
        let url = "{{route('dashboard.user.store')}}";
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($("#formStoreUser form")[0]),
            processData: false,
            contentType: false,
            async: false,
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        type: 'success',
                        title: 'Create User Successfully',
                        text: response.message,
                        timer: 3000,
                        showCancelButton: false,
                    }).then(function() {
                        window.location.href = "{{route('dashboard.user.index')}}";
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text: response.message
                    });
                }
            }
        })
    });
</script>
<script>
    let inputFile;
    let uploadPhoto = document.querySelector(".upload-photo");
    let previewImage = document.querySelector(".preview-image");

    uploadPhoto.addEventListener("change", function() {
        inputFile = this.files[0];
        previewPhoto();
    });

    function previewPhoto() {
        let fileType = inputFile.type;
        let validExtensions = ["image/jpeg", "image/jpg", "image/png"];

        if (validExtensions.includes(fileType)) {
            let fileReader = new FileReader();

            fileReader.onload = () => {
                let fileURL = fileReader.result;
                previewImage.src = fileURL;
            }
            fileReader.readAsDataURL(inputFile);
        }
    };
</script>

@endsection

@section('js')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection