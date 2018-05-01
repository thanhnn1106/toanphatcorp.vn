@extends('admin.layout')

@section('content')

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách FAQs</li>
        </ul>
    </div>
</div>
<?php
    $status = config('site.faqs_status.label')
?>
<section>
    <div class="container-fluid">
        @include('notifications')
        <!-- Page Header-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Danh sách FAQs</h1>
                        <a href="{{ route('admin.faqs.add') }}" class="btn btn-success btn-xs">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        @if (count($faqs) <= 0)
                        <span>No data found.</span>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Câu hỏi</th>
                                            <th>Câu trả lời</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;  ?>
                                        @foreach ($faqs as $item)
                                        <tr>
                                            <th scope="row">{{ ($faqs->currentpage()-1) * $faqs->perpage() + $i++ + 1 }}</th>
                                            <td>{{ $item->question }}</td>
                                            <td>{{ $item->answer }}</td>
                                            <td>
                                                <?php
                                                    $faqStatus = '';
                                                    if ($item->status == 0) {
                                                        $faqStatus = 'secondary';
                                                    } elseif ($item->status == 1) {
                                                        $faqStatus = 'success';
                                                    }
                                                ?>
                                                <div class="badge badge-{{ $faqStatus }}">
                                                    {{ $status[$item->status] }}
                                                </div>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.faqs.edit', ['id' => $item->id]) }}" class="btn btn-warning btn-xs">Cập nhật</a>
                                                <a href="javascript:void(0);" onclick="return fncDeleteConfirm(this);" 
                                                   data-message="Are you sure delete this faq?" 
                                                   data-url="{{ route('admin.faqs.delete', ['id' => $item->id]) }}" 
                                                   class="btn btn-danger btn-xs">
                                                   Xoá
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
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $faqs->firstItem() }} to {{ $faqs->count() }} of {{ $faqs->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $faqs->links() }}
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
