@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Admin</li>
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
                        <h1>Admins</h1>
                        <a class="btn btn-success btn-xs" href="{{ route('admin.admins.add') }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên tài khoản</th>
                                        <th>Vai trò</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($admins->count() == 0)
                                        <tr><td colspan="8" align="center">Data not found</td></tr>
                                    @else
                                    @foreach($admins as $admin)
                                    <tr>
                                        <th scope="row">{{ $admin->id }}</th>
                                        <td>{{ $admin->user_name }}</td>
                                        <td>{{ $admin->role->role }}</td>
                                        <td>
                                            <div class="badge badge-{{ ($admin->status == 0) ? 'warning' : 'primary' }}">
                                                {{ config('site.user_status.label')[$admin->status] }}
                                            </div>
                                        </td>
                                        <td>{{ $admin->created_at }}</td>
                                        <td>{{ $admin->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.admins.edit', ['adminId' => $admin->id]) }}" class="btn btn-warning btn-xs">
                                                Cập nhật
                                            </a>
                                            <a href="javascript:void(0);" onclick="return fncDeleteConfirm(this);"
                                               data-message="Are you sure delete this admin?"
                                               data-url="{{ route('admin.admins.delete', ['adminId' => $admin->id]) }}"
                                               class="btn btn-danger btn-xs">
                                                Delete
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
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $admins->firstItem() }} to {{ $admins->count() }} of {{ $admins->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $admins->links() }}
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