@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tags') }}">Tags</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
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
                              <label class="col-sm-2 form-control-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control @if ($errors->has('name'))is-invalid @endif" value="{{ old('name', isset($tag->name) ? $tag->name : '') }}">
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Trạng thái</label>
                                <div class="col-sm-10">
                                  <div class="i-checks">
                                    <input id="status_1" type="radio" value="{{ $status['is_popular'] }}" @if (old('is_popular', isset($tag->is_popular) ? $tag->is_popular : '') == 1) checked="checked" @endif name="is_popular" class="form-control-custom radio-custom">
                                    <label for="status_1">Phổ biến</label>
                                  </div>
                                  <div class="i-checks">
                                    <input id="status_0" type="radio" value="{{ $status['is_not_popular'] }}" @if (old('is_popular', isset($tag->is_popular) ? $tag->is_popular : '') != 1) checked="checked" @endif name="is_popular" class="form-control-custom radio-custom">
                                    <label for="status_0">Không phổ biến</label>
                                  </div>
                                </div>
                                @if ($errors->has('is_popular'))
                                <div class="invalid-feedback">{{ $errors->first('is_popular') }}</div>
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
<script></script>
@endsection