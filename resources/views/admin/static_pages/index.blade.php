@extends('admin.layout')

@section('content')

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách các trang tĩnh</li>
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
                        <h1>Danh sách các trang tĩnh</h1>
                    </div>
                    <div class="card-body">
                        @if (count($staticPages) <= 0)
                        <span>No data found.</span>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên trang</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;  ?>
                                        @foreach ($staticPages as $item)
                                        <tr>
                                            <th scope="row">{{ ($staticPages->currentpage()-1) * $staticPages->perpage() + $i++ + 1 }}</th>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-xs">Chi tiết</a>
                                                <a href="{{ route('admin.staticPages.edit', ['pageId' => $item->id]) }}" class="btn btn-warning btn-xs">Cập nhật</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $staticPages->firstItem() }} to {{ $staticPages->count() }} of {{ $staticPages->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $staticPages->links() }}
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
