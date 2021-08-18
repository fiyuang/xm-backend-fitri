@extends('layouts.admin.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Schedule of {{ $data->guru->name }} and {{ $data->talent->name }}</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="date">Tanggal</label>
                    <input type="text" name="date" id="date" class="form-control" value="{{ $data->date_formatted }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="time">Waktu</label>
                    <input type="text" name="time" id="time" class="form-control" value="{{ $data->time }}" disabled>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label for="notes">Notes from user</label>
                    <textarea name="notes" id="notes" class="form-control" value="" disabled>{{ $data->notes }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="approved_reason">Approval reason from guru</label>
                    <textarea name="approved_reason" id="approved_reason" class="form-control" value="" disabled>{{ $data->approved_reason }}</textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control" value="{{ $data->status_formatted }}" disabled>
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