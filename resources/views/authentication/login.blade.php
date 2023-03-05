<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex justify-content-center">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back! </h1>
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
                                    </div>
                                    <form class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control form-control-user @error('email') is-invalid  @enderror" id=" exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required autofocus value="{{old('email')}}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <button href="index.html" class="btn btn-primary btn-user btn-block" id="submit_login">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>


    <!-- //note: Script for login post action -->
    <script type="text/javascript">
        // todo: Login action
        $('#submit_login').click(function(error) {
            error.preventDefault();
            let email = $('#email').val();
            let password = $('#password').val();
            if (!email) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: "Please fill the email",
                    showCancelButton: false,
                });
                return;
            } else if (!password) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: "Please fill the password",
                    showCancelButton: false,
                })
                return;

            }
            let url = "{{route('login.auth.custom')}}";
            let _token = "{{ csrf_token() }}";
            let data = {
                email,
                password,
                _token
            };
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                dataType: "JSON",
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            type: 'success',
                            title: 'Login Berhasil!',
                            text: response.message,
                            timer: 3000,
                            showCancelButton: false,
                        }).then(function() {
                            window.location.href = "{{route('dashboard.index_welcome')}}";
                        });
                    } else {
                        console.log(response);
                        Swal.fire({
                            type: 'error',
                            title: 'Login Gagal!',
                            text: response.message
                        });
                    }
                }
            });
        });
    </script>

</body>

</html>