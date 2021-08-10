<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Our Guru - XM Fitri</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">XM Fitri</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        @role('Talent')
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/user/schedule-list">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="/guru-list">Our Guru</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/guru/schedule-list">Home</a></li>
                        @endrole  
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/detail-profile">Profile</a></li>                    
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guru</span>
                                <img class="img-profile rounded-circle small" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-right: -50px;">
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
            <h2 class="fw-bolder mb-4" style="text-align: center;">Your Schedule</h2><br>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama User</th>
                                    <th>Nama Guru</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>                           
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $schedule->talent->name }}</td>
                                    <td>{{ $schedule->guru->name }}</td>                          
                                    <td> 
                                        @if($schedule->is_approved == 1)
                                            <span class="badge badge-pill badge-warning">Waiting</span>
                                        @elseif ($schedule->is_approved == 2)
                                            <span class="badge badge-pill badge-success">Approved</span>
                                        @elseif ($schedule->is_approved == 3)
                                            <span class="badge badge-pill badge-danger">Not Approved</span>
                                        @elseif ($schedule->is_approved == 4)
                                            <span class="badge badge-pill badge-success">Saved</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Decline</span>
                                        @endif
                                    </td>
                                    <td>{{ $schedule->scheduledate }}</td>
                                    <td>{{ $schedule->time }}</td>
                                    <td><a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $schedule->id }}"
                                            class="btn btn-primary btn-sm update-schedule ml-1">
                                            Detail</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="updateSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUpdateSchedule" name="formUpdateSchedule" autocomplete="off">
                        <div class="modal-body">
                            <div class="alert alert-danger" style="display:none"></div>

                            <input type="hidden" name="schedule_id" id="schedule_id" class="form-control" value="">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dob">Nama User</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="time">Email User</label>
                                    <input type="text" name="user_email" id="user_email" class="form-control" value="" disabled>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dob">No. Telepon</label>
                                    <input type="text" name="user_number" id="user_number" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="time">CV User</label>
                                    <div class="border border-dashed rounded d-flex justify-content" style="background: #eaecf4; padding: 6px;">
                                        &nbsp;<a href="#" target="_blank" class="userCV">Lihat CV</a>                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Catatan</label>
                                <textarea name="notes" id="notes" class="form-control" value="" disabled></textarea>
                            </div><hr>  

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dob">Tanggal</label>
                                    <input type="text" name="schedule_date" id="schedule_date" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="time">Waktu</label>
                                    <input type="text" name="schedule_time" id="schedule_time" class="form-control" value="" disabled>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" id="is_approved" name="is_approved" style="width: 100%;">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="1">Waiting</option>
                                    <option value="2">Approved</option>
                                    <option value="3">Not Approved</option>
                                </select>
                            </div>
                                               
                            <div class="form-group">
                                <label for="name">Apporved Reason</label>
                                <textarea name="approved_reason" id="approved_reason" class="form-control" value=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm update-data">Update</button>
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
        <script src="../js/scripts.js"></script>
        <script src="../js/sb-admin-2.min.js"></script>

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

        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('click', '.update-schedule', function () {
                    var id = $(this).attr('data-id');
                    $.get('/schedule/' + id + '/json', function (data) {
                        console.log(data)

                        $('#user_name').val(data.talent.name);
                        $('#user_email').val(data.talent.email);
                        $('#user_number').val(data.talent.profile.mobile_number);
                        $(".userCV").attr("href",data.talent.cv.file_path);
                        $("#notes").val(data.notes);
                        $('#schedule_date').val(data.scheduledate);
                        $('#schedule_time').val(data.time);
                        $("#is_approved").val(data.is_approved);
                        $("#approved_reason").val(data.approved_reason);

                        $('#schedule_id').val(id);
                        $('#updateSchedule').modal('show');
                    });
                    
                });

                // Handle Submit Document
                if ($("#updateSchedule").length > 0) {
                    $("#formUpdateSchedule").validate({

                        submitHandler: function(form) {

                            $(".update-data").attr("disabled", true);
                            $('.update-data').html('Sending..');

                            var form = $('#formUpdateSchedule')[0];

                            var formDatata = new FormData(form);

                            $.ajax({
                                data: formDatata,
                                url: '/update-schedule',
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
                                        $(".update-data").attr("disabled", false);
                                        $('.update-data').html('Submit');

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
                                    $(".update-data").attr("disabled", false);
                                    $('.update-data').html('Submit');
                                }
                            });
                        }
                    });
                }
            })
        </script>

    </body>
</html>
