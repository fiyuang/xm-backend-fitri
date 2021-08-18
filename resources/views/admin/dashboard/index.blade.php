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
                            <td>{{ $schedule->date_formatted }}</td>
                            <td>{{ $schedule->time }}</td>
                            <td>
                                <a href="{{ route('schedule.detail',$schedule->id) }}" class="btn btn-primary btn-sm ml-1"><i class="fas fa-eye fa-fw"></i> Detail</a>
                                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $schedule->id }}" class="btn btn-warning btn-sm log-activity ml-1"> Log</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('admin/dashboard/_log_schedule')

<!-- /.container-fluid -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '.log-activity', function () {
                    $('#logActivityModal').modal('show');
                    var id = $(this).data("id");
                    $('.tablelogactivity').DataTable({
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "/schedule/"+id+"/log-activity"
                        },
                        columns: [
                            {
                                data: 'DT_RowIndex', name: 'DT_RowIndex', 
                                orderable: false, searchable: false,  width: '5%'
                            },
                            {data: 'causer.name', name: 'causer.name', class:'text-center', width: '18%', },                         
                            {data: 'description', name: 'description', class:'text-center', width: '12%', },
                            {data: 'status_before', name: 'status_before', class:'text-center',  width: '17%', },
                            {data: 'status_after', name: 'status_after', class:'text-center',  width: '15%',},
                            {data: 'reason', name: 'reason', class:'text-center',  width: '10%',},
                            {data: 'created_at', name: 'created_at', class:'text-center',  width: '20%',},
                        ]    
                    });
                });
    })

</script>
@endsection
