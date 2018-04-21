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
                                        <th scope="row">{{ $file->id }}</th>
                                        <td><a target="_blank" href="{{ $file->getCoverImageUrl() }}">{{ $file->getCoverImage() }}</a></td>
                                        <td><a target="_blank" href="{{ $file->getThumbnailUrl() }}">{{ $file->getThumbnail() }}</a></td>
                                        <td>
                                            @if( ! empty($categories[$file->id]))
                                            @foreach ($categories[$file->id] as $cate)
                                            <a href="{{ route('admin.category.edit', ['categoryId' => $cate['id']]) }}">{{ $cate['name'] }}</a><br/>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $file->title }}</td>
                                        <td>{{ $file->file_name }}</td>
                                        <td>{{ $file->getTypeDownloadLabel() }}</td>
                                        <td>{{ $file->getStatusLabel() }}</td>
                                        <td>
                                            <a href="{{ route('admin.files.edit', ['fileId' => $file->id]) }}" class="btn btn-default btn-xs">Edit</a>
                                            <a href="javascript:void(0);" onclick="return fncDeleteConfirm(this);" data-message="Are you sure delete this file" data-url="{{ route('admin.files.delete', ['fileId' => $file->id]) }}" class="btn btn-default btn-xs">Delete</a>
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