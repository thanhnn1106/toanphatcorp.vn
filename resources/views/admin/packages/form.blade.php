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
                                    <input type="text" name="name" 
                                           class="form-control @if ($errors->has('name')) is-invalid @endif"
                                           value="{{ old('name', isset($packageInfo->name)) ? $packageInfo->name : ''}}">
                                    @if ($errors->has('name'))
                                        <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Số tháng</label>
                                <div class="col-sm-10 mb-3">
                                    <select name="number_month" 
                                        class="form-control @if ($errors->has('number_month')) is-invalid @endif"
                                        value="{{ old('number_month', isset($packageInfo->number_month)) ? $packageInfo->number_month : ''}}">
                                        @foreach ($packageRangeMonth as $key => $value)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('number_month'))
                                        <p class="help-block text-danger">{{ $errors->first('number_month') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Giá tiền</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price" 
                                           class="form-control @if ($errors->has('price')) is-invalid @endif"
                                           value="{{ old('price', isset($packageInfo->price)) ? $packageInfo->price : ''}}">
                                    @if ($errors->has('price'))
                                        <p class="help-block text-danger">{{ $errors->first('price') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Miêu tả</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control border-corner editor-content" rows="3">{{ old('description', isset($packageInfo->description)) ? $packageInfo->description : ''}}</textarea>
                                    @if ($errors->has('description'))
                                        <p class="help-block text-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <div>
                                        <input type="radio" value="1" name="status" checked="{{ old('status', isset($packageInfo->status) == '1') ? 'checked' : ''}}">
                                        <label for="optionsRadios1">Hiển thị</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="0" name="status" checked="{{ old('status', isset($packageInfo->status) == '0') ? 'checked' : ''}}">
                                        <label for="optionsRadios2">Không hiển thị</label>
                                    </div>
                                    @if ($errors->has('status'))
                                        <p class="help-block text-danger">{{ $errors->first('status') }}</p>
                                    @endif
                                </div>
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
