@extends('layouts.admin.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Our Guru</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Guru</h6>
        </div>
        <div class="card-body">
            <!-- <a href="" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#ModalFormHR"
                style="margin-bottom: 20px;">
                <i class="fa fa-plus"></i>&nbsp; &nbsp; Tambah Guru
            </a> -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%">No.</th>
                            <th width="35%">Nama</th>
                            <th width="35%">Email</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($hrs as $hr)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $hr->name }}</td>
                            <td>{{ $hr->email }}</td>
                            <td>
                                <a href="{{ route('guru.detail',$hr->id) }}" class="btn btn-primary btn-sm ml-1"><i class="fas fa-eye fa-fw"></i> Detail</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#remove-data-popup"
                                        data-action=""
                                    >
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>                             
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('admin/hr/_create_hr_modals')
@include('admin/hr/_detail_hr_modals')

@if(Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
    </div>
@endif

<!-- /.container-fluid -->
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('vendor/jquery-mask/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom/admin/hr.js') }}"></script>
@endsection