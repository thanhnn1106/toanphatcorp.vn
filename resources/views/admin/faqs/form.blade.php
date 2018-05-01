@extends('admin.layout')

@section('content')

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.faqs') }}">Danh sách FAQs</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ul>
    </div>
</div>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Nhập thông tin FAQs</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ $actionForm }}">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Câu hỏi</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                           id="question"
                                           name="question"
                                           class="form-control @if ($errors->has('question'))is-invalid @endif"
                                           value="{{ old('question', isset($faqInfo->question) ? $faqInfo->question : '') }}"
                                    />
                                    @if ($errors->has('question'))
                                    <div class="invalid-feedback">{{ $errors->first('question') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Câu trả lời</label>
                                <div class="col-sm-10">
                                    <textarea name="answer" class="form-control border-corner editor-content  @if ($errors->has('answer'))is-invalid @endif" rows="3">{{ old('answer', isset($faqInfo->answer) ? $faqInfo->answer : '') }}</textarea>
                                    @if ($errors->has('answer'))
                                    <div class="invalid-feedback">{{ $errors->first('answer') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Trạng thái</label>
                                <div class="col-sm-10">
                                  <div class="i-checks">
                                    <input id="status_1" type="radio" value="{{ $status['active'] }}" @if (old('status', isset($faqInfo->status) ? $faqInfo->status : '') == 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
                                    <label for="status_1">Hiển thị</label>
                                  </div>
                                  <div class="i-checks">
                                    <input id="status_0" type="radio" value="{{ $status['inactive'] }}" @if (old('status', isset($faqInfo->status) ? $faqInfo->status : '') != 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
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
                                    <a href="{{ route('admin.faqs') }}" class="btn btn-secondary">Huỷ</a>
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
