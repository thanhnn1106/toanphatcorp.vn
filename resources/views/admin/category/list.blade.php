@extends('admin.layout')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
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
                        <h1>Categories</h1>
                        <a class="btn btn-success btn-xs" href="{{ route('admin.category.add') }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cover image</th>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories)==0)
                                        <tr><td colspan="7" align="center">Data not found</td></tr>
                                    @else
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td><a target="_blank" href="{{ $category->getCoverImageUrl() }}">{{ $category->getCoverImage() }}</a></td>
                                        <td><a target="_blank" href="{{ $category->getThumbnailUrl() }}">{{ $category->getThumbnail() }}</a></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', ['categoryId' => $category->id]) }}" class="btn btn-default btn-xs">Edit</a>
                                            <a href="javascript:void(0);" onclick="return fncDeleteConfirm(this);" data-message="Are you sure delete this category" data-url="{{ route('admin.category.delete', ['categoryId' => $category->id]) }}" class="btn btn-default btn-xs">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $categories->firstItem() }} to {{ $categories->count() }} of {{ $categories->total() }} entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $categories->links() }}
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