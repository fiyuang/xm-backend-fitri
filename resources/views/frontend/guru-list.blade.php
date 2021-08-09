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
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
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
                                <img class="img-profile rounded-circle small" src="{{ asset('img/undraw_profile.svg') }}">
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
            <h2 class="fw-bolder mb-4" style="text-align: center;">Guru Lists</h2><br>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
                    @php $i = 1 @endphp
                    @foreach ($hrs as $hr)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top mb-5 mb-md-0" src="{{ $hr->profile->profile_picture }}" alt="..." style/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $hr->name }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        @foreach ($hr->trx_tag as $tag)
                                        <span class="badge badge-info">{{ $tag->tag_name }}</span> &nbsp;&nbsp;&nbsp;
                                        @endforeach
                                    </div>
                                    
                                    PT. Lorem Ipsum
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="row card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="col md-6">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Lihat Profil</a></div>
                                </div>
                                <div class="col md-6">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto create-schedule" href="#" data-id="{{ $hr->id }}">Pilih HR</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="modal fade" id="createSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formCreateSchedule" name="formCreateSchedule" autocomplete="off">
                        <div class="modal-body">
                            <div class="alert alert-danger" style="display:none"></div>

                            <input type="hidden" name="guru_id" id="guru_id" class="form-control" value="">
                            <input type="hidden" name="_token" id="_token" class="form-control" value="{{ csrf_token() }}">

                            <div class="form-group col">
                                <label for="dob">Pilih Tanggal</label>
                                <input type="text" name="schedule_date" id="schedule_date" class="form-control" value="">
                            </div>

                            <div class="form-group col">
                                <label for="time">Pilih Waktu</label>
                                <input type="text" name="schedule_time" id="schedule_time" class="form-control" value="">
                            </div>

                            <div class="form-group col">
                                <label for="name">Catatan</label>
                                <textarea name="notes" id="notes" class="form-control" value=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm book-data">Book!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Logout Modal-->
        @include('components/admin/_logout')
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script type="text/javascript" src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('vendor/jquery-mask/jquery.mask.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>

        <script src="{{ asset('js/sweetalert.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#schedule_date").datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 1,
                    beforeShowDay: $.datepicker.noWeekends
                });

                $("#schedule_time").timepicker({
                    timeFormat: 'H:mm',
                    interval: 30,
                    minTime: '10',
                    maxTime: '18:00',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true,
                    zindex: 9999999
                });

                $('body').on('click', '.create-schedule', function () {
                    var id = $(this).attr('data-id');
                    $('#guru_id').val(id);
                    $('#createSchedule').modal('show');
                });

                // Handle Submit Document
                if ($("#createSchedule").length > 0) {
                    $("#formCreateSchedule").validate({
                        rules: {
                            "schedule_date": "required",
                            "schedule_time": "required",
                        },
                        messages: {
                            "schedule_date": "Tanggal Perlu Diisi",
                            "schedule_time": "Jam Perlu Diisi",
                        },
                        errorElement: 'span',
                            errorPlacement: function (error, element) {
                                error.addClass('invalid-feedback');
                                element.closest('.form-group').append(error);
                            },
                            highlight: function (element, errorClass, validClass) {
                                $(element).addClass('is-invalid');
                            },
                            unhighlight: function (element, errorClass, validClass) {
                                $(element).removeClass('is-invalid');
                            },

                        submitHandler: function(form) {

                            $(".book-data").attr("disabled", true);
                            $('.book-data').html('Sending..');

                            var form = $('#formCreateSchedule')[0];

                            var formDatata = new FormData(form);

                            $.ajax({
                                data: formDatata,
                                url: '/create-schedule',
                                type: "POST",
                                contentType: false,
                                enctype: 'multipart/form-data',
                                processData: false,  // Important!
                                dataType: 'json',
                                success: function (data) {
                                    console.log(data);
                                    if(data.errors){

                                        jQuery('.alert-danger').html('');
                                        jQuery.each(data.errors, function(key, value){
                                            jQuery('.alert-danger').show();
                                                jQuery('.alert-danger').append('<li>'+value+'</li>');
                                        });
                                        $(".book-data").attr("disabled", false);
                                        $('.book-data').html('Submit');

                                    } else {
                                        if(data.success == true) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.message,
                                                showConfirmButton: true,
                                            }).then(() => {
                                                location.reload(true);
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: data.message,
                                                showConfirmButton: true,
                                            }).then(() => {
                                                location.reload(true);
                                            })
                                            
                                        }
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                    $(".book-data").attr("disabled", false);
                                    $('.book-data').html('Submit');
                                }
                            });
                        }
                    });
                }
            })
        </script>

    </body>
</html>
