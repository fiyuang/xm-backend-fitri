@extends('layouts.admin.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Guru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nama Panjang</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('components/admin/_detail_patient')

<!-- /.container-fluid -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '.detail-patient', function () {
            var id = $(this).data('id');
            $.get('patient/' + id + '/json', function (data) {
                console.log(data)

                var datetime_appointment = (data.date) + ", " + (data.time)

                $('.name').html(data.patient.name);
                $('.mobile_number').html(data.patient.mobile_number);
                $('.dob').html(data.patient.date_of_birth);
                $('.doctor').html(data.doctor.name);
                $('.datetime_appointment').html(datetime_appointment);
                $('.notes').html(data.notes);

                $('#detail-patient').modal('show');
            });
        });
    })

</script>
@endsection
