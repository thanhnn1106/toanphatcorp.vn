@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Category</a></li>
            <li class="breadcrumb-item active">Form</li>
        </ul>
    </div>
</div>
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

                                @if( ! empty($category) && $category->getCoverImageUrl())
                                <a target="_blank" href="{{ $category->getCoverImageUrl() }}">{{ $category->getCoverImage() }}</a>
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

                                @if( ! empty($category) && $category->getThumbnailUrl())
                                <a target="_blank" href="{{ $category->getThumbnailUrl() }}">{{ $category->getThumbnail() }}</a>
                                @endif

                                @if ($errors->has('thumbnail'))
                                <div class="invalid-feedback">{{ $errors->first('thumbnail') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control @if ($errors->has('name'))is-invalid @endif" value="{{ old('name', isset($category->name) ? $category->name : '') }}">
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 form-control-label">Description</label>
                              <div class="col-sm-10">
                                <input type="text" name="description" class="form-control @if ($errors->has('description'))is-invalid @endif"  value="{{ old('description', isset($category->description) ? $category->description : '') }}">
                                @if ($errors->has('description'))
                                <div class="invalid-feedback">{{ $errors->first('description', isset($category->name) ? $category->name : '') }}</div>
                                @endif
                              </div>
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
<script></script>
@endsection