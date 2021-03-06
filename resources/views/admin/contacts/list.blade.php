@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
        </ul>
    </div>
</div>
<?php 
    $status = config('site.contact_status.label');
?>
<section>
    <div class="container-fluid">
        @include('notifications')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Contacts</h1>
                    </div>
                    <div class="card-header">
                        <form id="searchContact" method="GET" action="{{ route('admin.contacts') }}">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="email" type="text" class="form-control" placeholder="Enter user email..." value="{{ $email }}" />
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Go!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control" name="filter_status" onchange="this.form.submit();">
                                                <option value="">All</option>
                                                @foreach ($status as $key => $value)
                                                <option @if ($filter_status != '' && (int)$key === (int)$filter_status) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
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
                                        <th>Địa chỉ email</th>
                                        <th>Tiêu đề</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($contacts->count() == 0)
                                        <tr><td colspan="9" align="center">Data not found</td></tr>
                                    @else
                                    <?php $i = ($contacts->currentpage()-1) * $contacts->perpage() + 1; ?>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td style="width: 5%;" scope="row">{{ $i++ }}</td>
                                        <td style="width: 15%;">{{ $contact->name }}</td>
                                        <td style="width: 15%;">{{ $contact->email }}</td>
                                        <td style="width: 20%;">{{ $contact->title }}</td>
                                        <td style="width: 10%;">
                                            <?php
                                                $contactStatus = '';
                                                if ($contact->status == 0) {
                                                    $contactStatus = 'primary';
                                                } elseif ($contact->status == 1) {
                                                    $contactStatus = 'warning';
                                                } else {
                                                    $contactStatus = 'secondary';
                                                }
                                            ?>
                                            <div class="badge badge-{{ $contactStatus }}">
                                                {{ $status[$contact->status] }}
                                            </div>
                                        </td>
                                        <td style="width: 10%;">{{ $contact->created_at }}</td>
                                        <td style="width: 10%;">{{ $contact->updated_at }}</td>
                                        <td style="width: 15%;">
                                            <a href="{{ route('admin.contacts.edit', ['contactId' => $contact->id]) }}" class="btn btn-warning btn-xs">
                                               Cập nhật
                                            </a>
                                            <a href="javascript:void(0);" onclick="return fncDeleteConfirm(this);"
                                               data-message="Are you sure delete this contacts?"
                                               data-url="{{ route('admin.contacts.delete', ['contactId' => $contact->id]) }}"
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
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $contacts->firstItem() }} to {{ $contacts->count() }} of {{ $contacts->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $contacts->appends(request()->input())->links() }}
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