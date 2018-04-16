@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ul>
    </div>
</div>
<?php
$status = config('site.user_status.value');
?>
<section>
    <div class="container-fluid">
        @include('notifications')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ $actionForm }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tên tài khoản</label>
                                <div class="col-sm-10">
                                    <input type="text" id="user_name" name="user_name" class="form-control @if ($errors->has('user_name'))is-invalid @endif"
                                           value="{{ old('user_name', isset($user->user_name) ? $user->user_name : '') }}">
                                    @if ($errors->has('user_name'))
                                    <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tên thành viên</label>
                                <div class="col-sm-10">
                                    <input type="text" id="full_name" name="full_name" class="form-control @if ($errors->has('full_name'))is-invalid @endif"
                                           value="{{ old('full_name', isset($user->full_name) ? $user->full_name : '') }}">
                                    @if ($errors->has('full_name'))
                                    <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Địa chỉ email</label>
                                <div class="col-sm-10">
                                    <input type="text" id="email" name="email" class="form-control @if ($errors->has('email'))is-invalid @endif" value="{{ old('email', isset($user->email) ? $user->email : '') }}">
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Mật khẩu</label>
                                <div class="col-sm-10">
                                    <input type="text" id="password" name="password" class="form-control @if ($errors->has('password'))is-invalid @endif" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        <input id="status_1" type="radio" value="{{ $status['active'] }}" @if (old('status', isset($user->status) ? $user->status : '') == 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
                                               <label for="status_1">Active</label>
                                    </div>
                                    <div class="i-checks">
                                        <input id="status_0" type="radio" value="{{ $status['inactive'] }}" @if (old('status', isset($user->status) ? $user->status : '') != 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
                                               <label for="status_0">Inactive</label>
                                    </div>
                                </div>
                                @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer_script')
<link href="{{ asset('plugins/bootstrap-tagsinput/tagsinput.css') }}" rel="stylesheet"/>
<script src="{{ asset('plugins/bootstrap-tagsinput/tagsinput.js') }}"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
@endsection
