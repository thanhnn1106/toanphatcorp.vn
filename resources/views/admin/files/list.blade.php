@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Files</li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        @include('notifications')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Files</h1>
                        <a class="btn btn-success btn-xs" href="{{ route('admin.files.add') }}">Thêm mới</a>
                    </div>
                    <div class="card-header">
                        <form id="searchFile" method="GET" action="{{ route('admin.files') }}">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="col-sm-3 form-control-label">Loại file</label>
                                            <select class="form-control" name="filter_type_download" onchange="this.form.submit();">
                                                <option value="">All</option>
                                                @foreach ($type_download as $key => $value)
                                                <option @if ($filter_type_download != '' && (int)$key === (int)$filter_type_download) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="col-sm-4 form-control-label">Trạng thái</label>
                                            <select class="form-control" name="filter_status" onchange="this.form.submit();">
                                                <option value="">All</option>
                                                @foreach ($status as $key => $value)
                                                <option @if ($filter_status != '' && (int)$key === (int)$filter_status) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="title" type="text" class="form-control" placeholder="Enter file title..." value="{{ $title }}" />
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Go!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cover image</th>
                                        <th>Thumbnail</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>File name</th>
                                        <th>Type download</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($files->count() == 0)
                                        <tr><td colspan="9" align="center">Data not found</td></tr>
                                    @else
                                    @foreach($files as $file)
                                    <tr>
                                        <th style="width: 5%;" scope="row">{{ $file->id }}</th>
                                        <td style="width: 10%;"><a target="_blank" href="{{ $file->getCoverImageUrl() }}">{{ $file->getCoverImage() }}</a></td>
                                        <td style="width: 10%;"><a target="_blank" href="{{ $file->getThumbnailUrl() }}">{{ $file->getThumbnail() }}</a></td>
                                        <td style="width: 15%;">
                                            @if( ! empty($categories[$file->id]))
                                            @foreach ($categories[$file->id] as $cate)
                                            <a href="{{ route('admin.category.edit', ['categoryId' => $cate['id']]) }}">{{ $cate['name'] }}</a><br/>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td style="width: 15%;">{{ $file->title }}</td>
                                        <td style="width: 20%;">{{ $file->file_name }}</td>
                                        <td style="width: 5%;">{{ $file->getTypeDownloadLabel() }}</td>
                                        <td style="width: 5%;">
                                            <?php
                                                $fileStatus = '';
                                                if ($file->status == 0) {
                                                    $fileStatus = 'secondary';
                                                } elseif ($file->status == 1) {
                                                    $fileStatus = 'success';
                                                }
                                            ?>
                                            <div class="badge badge-{{ $fileStatus }}">
                                                {{ $file->getStatusLabel() }}
                                            </div>
                                        </td>
                                        <td style="width: 15%;">
                                            <a href="{{ route('admin.files.edit', ['fileId' => $file->id]) }}"
                                               class="btn btn-warning btn-xs">
                                               Cập nhật
                                            </a>
                                            <a href="javascript:void(0);"
                                               onclick="return fncDeleteConfirm(this);"
                                               data-message="Are you sure delete this file?"
                                               data-url="{{ route('admin.files.delete', ['fileId' => $file->id]) }}"
                                               class="btn btn-danger btn-xs">
                                               Xoá
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $files->firstItem() }} to {{ $files->count() }} of {{ $files->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $files->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer_script')
@endsection