@extends('layouts.admin.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Our Guru</h1>
    </div> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail of {{ $data->name }}</h6>
        </div>
        <div class="card-body">
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
                    <label for="">Status</label>
                        <select class="form-control" name="status" id="status" data-id="{{ $data->id }}">
                            <option value="1" {{ $data->status == '1' ? "selected" : "" }}> Baru</option>
                            <option value="2" {{ $data->status == '2' ? "selected" : "" }}> Menunggu Direview</option>
                            <option value="3" {{ $data->status == '3' ? "selected" : "" }}> Approved</option>
                            <option value="4" {{ $data->status == '4' ? "selected" : "" }}> Ditolak</option>
                        </select>
                </div>
                <div class="col-md-6">
                    <label for="name">CV</label>
                    <div class="border border-dashed rounded d-flex justify-content" style="background: #eaecf4; padding: 6px;">
                        &nbsp;<a href="{{ asset($data->cv->file_path) }}" target="_blank">{{ $data->cv->file_name }}</a>                       
                    </div>
                </div>
            </div><br>
            
        </div>
    </div>

</div>

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