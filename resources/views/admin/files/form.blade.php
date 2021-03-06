@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.files') }}">Files</a></li>
            <li class="breadcrumb-item active">Form</li>
        </ul>
    </div>
</div>
<?php 
    $typeDownload = config('site.type_download.value');
    $status = config('site.file_status.value');
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
                              <label class="col-sm-2 form-control-label">Cover image</label>
                              <div class="col-sm-10">
                                <input type="file" id="cover_image" name="cover_image" class="form-control @if ($errors->has('cover_image'))is-invalid @endif">

                                @if( ! empty($file->cover_image) && $file->getCoverImageUrl())
                                <a target="_blank" href="{{ $file->getCoverImageUrl() }}">{{ $file->getCoverImage() }}</a>
                                @endif

                                @if ($errors->has('cover_image'))
                                <div class="invalid-feedback">{{ $errors->first('cover_image') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Thumbnail</label>
                              <div class="col-sm-10">
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control @if ($errors->has('thumbnail'))is-invalid @endif">

                                @if( ! empty($file->thumbnail) && $file->getThumbnailUrl())
                                <a target="_blank" href="{{ $file->getThumbnailUrl() }}">{{ $file->getThumbnail() }}</a>
                                @endif

                                @if ($errors->has('thumbnail'))
                                <div class="invalid-feedback">{{ $errors->first('thumbnail') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Category</label>
                                <div class="col-sm-10 mb-3">
                                  <?php
                                    $selectedCates = Request::old('category', isset($file) ? array_column($file->categories->toArray(), 'id') : array());
                                  ?>
                                  <select id="category" name="category[]" class="form-control" multiple="multiple">
                                    @foreach($categories as $cate)
                                    @if (is_array($selectedCates))
                                            <option value="{{ $cate->id }}" 
                                            @foreach ($selectedCates as $cateId)
                                              @if($cateId == $cate->id)
                                                selected
                                              @endif 
                                            @endforeach
                                            >{{ $cate->name }}</option>
                                    @else
                                      <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endif
                                  @endforeach
                                  </select>
                                  @if ($errors->has('category'))
                                    <div class="invalid-feedback" style="@if ($errors->has('category')) display:block @endif">{{ $errors->first('category') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Title</label>
                              <div class="col-sm-10">
                                <input type="text" id="title" name="title" class="form-control @if ($errors->has('title'))is-invalid @endif" value="{{ old('title', isset($file->title) ? $file->title : '') }}">
                                @if ($errors->has('title'))
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Tags</label>
                              <div class="col-sm-10">
                                <input type="text" id="tag_name" name="tag_name" class="form-control @if ($errors->has('tag_name'))is-invalid @endif" data-role="tagsinput" value="{{ old('tag_name', isset($file) ? $file->getTagNames() : '') }}">
                                @if ($errors->has('tag_name'))
                                <div class="invalid-feedback">{{ $errors->first('tag_name') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">File name</label>
                              <div class="col-sm-10">
                                <input type="text" id="file_name" name="file_name" class="form-control @if ($errors->has('file_name'))is-invalid @endif" value="{{ old('file_name', isset($file->file_name) ? $file->file_name : '') }}">
                                @if ($errors->has('file_name'))
                                <div class="invalid-feedback">{{ $errors->first('file_name') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Date input</label>
                              <div class="col-sm-10">
                                <input type="text" id="date_input" name="date_input" class="form-control @if ($errors->has('date_input'))is-invalid @endif" value="{{ old('date_input', isset($file->date_input) ? $file->getFormatDateInput() : '') }}">
                                @if ($errors->has('date_input'))
                                <div class="invalid-feedback">{{ $errors->first('date_input') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Track list</label>
                              <div class="col-sm-10">
                                <textarea name="track_list" class="form-control border-corner editor-content  @if ($errors->has('track_list'))is-invalid @endif" rows="3">{{ old('track_list', isset($file->track_list) ? $file->track_list : '') }}</textarea>
                                @if ($errors->has('track_list'))
                                <div class="invalid-feedback">{{ $errors->first('track_list') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Type download</label>
                                <div class="col-sm-10">
                                  <div class="i-checks">
                                    <input id="type_download_1" type="radio" value="{{ $typeDownload['premium'] }}" @if (old('type_download', isset($file->type_download) ? $file->type_download : '') == 1) checked="checked" @endif name="type_download" class="form-control-custom radio-custom">
                                    <label for="type_download_1">Premium</label>
                                  </div>
                                  <div class="i-checks">
                                    <input id="type_download_0" type="radio" value="{{ $typeDownload['normal'] }}" @if (old('type_download', isset($file->type_download) ? $file->type_download : '') != 1) checked="checked" @endif name="type_download" class="form-control-custom radio-custom">
                                    <label for="type_download_0">Normal</label>
                                  </div>
                                </div>
                                @if ($errors->has('type_download'))
                                <div class="invalid-feedback">{{ $errors->first('type_download') }}</div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Status</label>
                                <div class="col-sm-10">
                                  <div class="i-checks">
                                    <input id="status_1" type="radio" value="{{ $status['active'] }}" @if (old('status', isset($file->status) ? $file->status : '') == 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
                                    <label for="status_1">Active</label>
                                  </div>
                                  <div class="i-checks">
                                    <input id="status_0" type="radio" value="{{ $status['inactive'] }}" @if (old('status', isset($file->status) ? $file->status : '') != 1) checked="checked" @endif name="status" class="form-control-custom radio-custom">
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
<script type="text/javascript" src="{{ asset('plugins/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" type="text/css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- TinyMCE -->
<script type="text/javascript" src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
$(function() {
    tinymce.init({
        selector: ".editor-content", 
        theme: "modern", 
        height: 400,
        subfolder:"",
        plugins: [ 
        "advlist autolink link image lists charmap print preview hr anchor pagebreak", 
        "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
        "table contextmenu directionality emoticons paste textcolor filemanager" 
        ], 
        image_advtab: true, 
        toolbar: "sizeselect | fontselect | fontsizeselect | undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
    });

    $('#category').multiselect();

    $("#date_input" ).datepicker();
});
</script>
@endsection