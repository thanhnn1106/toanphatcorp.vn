@extends('admin.layout')

@section('content')

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.package') }}">Danh sách Packages</a></li>
            <li class="breadcrumb-item active">Thêm Package</li>
        </ul>
    </div>
</div>
<?php
    $status = config('site.file_status.value');
?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Nhập thông tin package</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ $actionForm }}">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tên gói</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                           name="name" 
                                           class="form-control @if ($errors->has('name')) is-invalid @endif"
                                           value="{{ old('name', isset($packageInfo->name) ? $packageInfo->name : '') }}"
                                    >
                                    @if ($errors->has('name'))
                                        <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Số tháng</label>
                                <div class="col-sm-10 mb-3">
                                    <select name="number_days" 
                                        class="form-control @if ($errors->has('number_days')) is-invalid @endif"
                                        value="{{ old('number_days', isset($packageInfo->number_days) ? $packageInfo->number_days : '') }}">
                                        @foreach ($packageRangeMonth as $key => $value)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('number_days'))
                                        <p class="help-block text-danger">{{ $errors->first('number_days') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Giá tiền</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price" 
                                           class="form-control @if ($errors->has('price')) is-invalid @endif"
                                           value="{{ old('price', isset($packageInfo->price) ? $packageInfo->price : '') }}">
                                    @if ($errors->has('price'))
                                        <p class="help-block text-danger">{{ $errors->first('price') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Miêu tả</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control border-corner editor-content" rows="3">{{ old('description', isset($packageInfo->description) ? $packageInfo->description : '') }}</textarea>
                                    @if ($errors->has('description'))
                                        <p class="help-block text-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Trạng thái</label>
                                <div class="col-sm-10">
                                  <div class="i-checks">
                                    <input id="status_1" type="radio" value="{{ $status['active'] }}" @if (old('status', isset($packageInfo->status) ? $packageInfo->status : '') == 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
                                    <label for="status_1">Hiển thị</label>
                                  </div>
                                  <div class="i-checks">
                                    <input id="status_0" type="radio" value="{{ $status['inactive'] }}" @if (old('status', isset($packageInfo->status) ? $packageInfo->status : '') != 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
                                    <label for="status_0">Không hiển thị</label>
                                  </div>
                                </div>
                                @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-2">
                                    <a href="{{ route('admin.package') }}" class="btn btn-secondary">Huỷ</a>
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_script')

<!-- TinyMCE -->
<script type="text/javascript" src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
$(function() {
    tinymce.init({
        selector: ".editor-content", 
        theme: "modern", 
        height: 10,
        subfolder:"",
        plugins: [ 
        "advlist autolink link image lists charmap print preview hr anchor pagebreak", 
        "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
        "table contextmenu directionality emoticons paste textcolor filemanager" 
        ], 
        image_advtab: true, 
        toolbar: "sizeselect | fontselect | fontsizeselect | undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
    });
});
</script>

@endsection
