<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Our HR - XM Fitri</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">XM Fitri</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/hr-list">Our HR</a></li>
                    </ul>
                </div>
                <div class="d-flex">
                         <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow" style="margin-right: 50px;">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">User</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-right: -50px;">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-8">
                        <div>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Detail of Your Profile</h1>
                            </div>                   
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}" disabled>
                                </div>
                            </div><br> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Tanggal Lahir</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $data->profile->birthdate }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile_number">No. Telepon</label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ $data->profile->mobile_number }}" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mobile_number">Status</label>
                                    <input type="text" name="status" id="status" class="form-control" value="{{ $data->status_formatted }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">CV</label>
                                    <div class="border border-dashed rounded d-flex justify-content" style="background: #eaecf4; padding: 6px;">
                                        &nbsp;<a href="{{ asset($data->cv->file_path) }}" target="_blank">{{ $data->cv->file_name }}</a>                       
                                    </div>
                                </div>
                            </div><br>  
                            @if($data->user_type == 2)
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Tag</label>
                                    <div class="border border-dashed rounded d-flex justify-content" style="background: #eaecf4; padding: 6px;">
                                        @foreach ($data->trx_tag as $tag)
                                        <span class="badge badge-info">{{ $tag->tag_name}}</span>  &nbsp;
                                        @endforeach                            
                                    </div>
                                </div>
                            </div> 
                            @endif           
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img class="card-img-top mb-5 mb-md-0" src="{{ asset($data->profile->profile_picture) }}" alt="..." />
                    </div>
                </div>
            </div>
        </section>

        <!-- Logout Modal-->
    @include('components/admin/_logout')
    @include('components/admin/_delete_popup')
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Bootstrap core JavaScript-->
        <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script type="text/javascript" src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('vendor/jquery-mask/jquery.mask.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {  
                $('.js-example-basic-multiple').select2();
            })
        </script>

    </body>
</html>
