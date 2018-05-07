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
                    <div class="card-header">
                        <form id="searchTag" method="GET" action="{{ route('admin.tags') }}">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="name" type="text" class="form-control" placeholder="Enter tag name..." value="{{ $name }}" />
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Go!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control" name="is_popular" onchange="this.form.submit();">
                                                <option value="">All</option>
                                                @foreach ($status as $key => $value)
                                                <option @if ($is_popular != '' && (int)$key === (int)$is_popular) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
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
                                        <td>
                                            <div class="badge badge-{{ ($tag->is_popular == 0) ? 'secondary' : 'primary' }}">
                                                {{ $status[$tag->is_popular] }}
                                            </div>
                                        </td>
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
                                    {{ $tags->appends(request()->input())->links() }}
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