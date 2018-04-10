@extends('admin.layout')

@section('content')

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách Package</li>
        </ul>
    </div>
</div>

<section>
    <div class="container-fluid">
        @include('notifications')
        <!-- Page Header-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Danh sách Package</h4>
                        <br />
                        <a href="{{ route('admin.package_add') }}" class="btn btn-success">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        @if (count($packageList) <= 0)
                        <span>No data found.</span>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên gói</th>
                                            <th>Giá</th>
                                            <th>Trạng thái</th>
                                            <th>Mô tả</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;  ?>
                                        @foreach ($packageList as $item)
                                        <tr>
                                            <th scope="row">{{ ($packageList->currentpage()-1) * $packageList->perpage() + $i++ + 1 }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.package_view') }}" class="btn btn-info btn-xs">Chi tiết</a>
                                                <a href="{{ route('admin.package_edit', ['id' => $item->id]) }}" class="btn btn-warning btn-xs">Cập nhật</a>
                                                <a href="javascript:void(0);" onclick="return fncDeleteConfirm(this);" 
                                                   data-message="Are you sure delete this package?" 
                                                   data-url="{{ route('admin.package_delete', ['id' => $item->id]) }}" 
                                                   class="btn btn-danger btn-xs">Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $packageList->firstItem() }} to {{ $packageList->count() }} of {{ $packageList->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $packageList->links() }}
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