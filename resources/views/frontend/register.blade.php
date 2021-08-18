<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Our Guru - XM Fitri</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                        <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/guru-list">Our Guru</a></li> -->
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
                <div class="row gx-4 gx-lg-5 ">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x1000/e0e0e0/8295ff&text=complete+the+profile" alt="..." />
                    </div>
                    <div class="col-md-6" style="background-color: whitesmoke; border-radius: 30px;">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Complete Your Profile</h1>
                            </div>
                            <form method="POST" action="{{ route('complete.profile.store') }}" id="completeProfileForm" enctype="multipart/form-data">
                                {{ csrf_field() }}    
                                <div class="form-group">
                                    <label for="user_type">Pilih Role Anda</label>
                                        <select class="form-control" name="user_type" onchange="showDiv(this)">
                                            <option value="" disabled selected> Pilih </option>
                                            <option value="2">Guru</option>
                                            <option value="3">User</option>
                                        </select>
                                        @if ($errors->has('user_type'))
                                            <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" type="name" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter your name...">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="mobile_number">No Telepon</label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="" placeholder="contoh: 0878xxxx">
                                    @if ($errors->has('mobile_number'))
                                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="dob">Tanggal Lahir</label>
                                    <input type="date" name="dob" id="dob" class="form-control">
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>
      
                                <div class="form-group">
                                    <label for="profile_picture">Upload Profile Picture</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        @if ($errors->has('profile_picture'))
                                            <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cv">Upload CV</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="cv" name="cv">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        @if ($errors->has('cv'))
                                            <span class="text-danger">{{ $errors->first('cv') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group" id="hidden_div" style="display:none;">
                                    <label for="tags">Tags</label>
                                    <div class="custom-file">
                                        <select class="js-example-basic-multiple form-control" name="tags[]" id="tags" multiple="multiple" style="width: 100%">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('tags'))
                                        <span class="text-danger">{{ $errors->first('tags') }}</span>
                                    @endif
                                </div>                          

                                <hr>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Submit
                                </button>
                            </form>
                        </div>
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

                $("#calendar").datepicker({
                    minDate: 1,
                    beforeShowDay: $.datepicker.noWeekends
                });

                $("#waktu").timepicker({
                    timeFormat: 'H:mm',
                    interval: 30,
                    minTime: '10',
                    maxTime: '18:00',
                    defaultTime: '12',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
            })

            function showDiv(select){
                if(select.value==2){
                    document.getElementById('hidden_div').style.display = "block";
                } else{
                    document.getElementById('hidden_div').style.display = "none";
                }
            } 
        </script>

    </body>
</html>
