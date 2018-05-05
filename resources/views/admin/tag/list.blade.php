@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Danh sách Tag</li>
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
                        <h1>Tags</h1>
                        <a class="btn btn-success btn-xs" href="{{ route('admin.tags.add') }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Slug</th>
                                        <th>Phổ biến</th>
                                        <th>Ngày tạo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($tags)==0)
                                        <tr><td colspan="7" align="center">Data not found</td></tr>
                                    @else
                                    @foreach($tags as $tag)
                                    <tr>
                                        <th scope="row">{{ $tag->id }}</th>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td>{{ $tag->is_popular }}</td>
                                        <td>{{ $tag->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.tags.edit', ['tagId' => $tag->id]) }}" class="btn btn-warning btn-xs">
                                               Cập nhật
                                            </a>
                                            <a href="javascript:void(0);"
                                               onclick="return fncDeleteConfirm(this);"
                                               data-message="Are you sure delete this tag?"
                                               data-url="{{ route('admin.tags.delete', ['tagId' => $tag->id]) }}"
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
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $tags->firstItem() }} to {{ $tags->count() }} of {{ $tags->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $tags->links() }}
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