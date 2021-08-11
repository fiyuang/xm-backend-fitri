<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>XM Fitri</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <style>
            .custom-counter {
                counter-reset: section;
            },
            .custom-counter li::before {
                counter-increment: step-counter;
                content: counter(step-counter);
            }
        </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">XM Fitri</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/400x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- <div class="small mb-1">Review CV kamu yuk!</div>
                        <h1 class="display-5 fw-bolder">Langkah Review CV</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">Rp. 30.000</span>
                            <span>Free</span>
                        </div>
                        <p class="lead">Dapatkan ulasan lengkap tentang CV kamu langsung dari profesional yang kamu pilih</p>
                            <ul style="text-align: justify;" class="custom-counter">
                                <li>Register / Login terlebih dahulu</li>
                                <li>Upload CV kamu</li>
                                <li>Pilih HR</li>
                                <li>Pilih jadwal & booking</li>
                            </ul>
                        <div class="d-flex">
                        </div> -->
                    </div>
                    <div class="col-md-6" style="background-color: whitesmoke; border-radius: 30px;">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register Your Account</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}" id="registerForm">
                                @csrf
                                @if(session('errors'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Something it's wrong:
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email..." required autocomplete="email" autofocus>
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password..." required autocomplete="current-password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                                <hr>
                                <a href="{{ url('auth/google') }}" class="btn btn-google btn-user btn-block">
                                    <i class="fa fa-google"></i> Login with Google
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <p class="small">Already have an account? <a href="/login"> Login here!</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
        <script src="js/sb-admin-2.min.js"></script>
    </body>
</html>
