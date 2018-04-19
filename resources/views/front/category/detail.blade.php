@extends('front.layout')
@section('content')
<div class="top_info_subpage">
    <div class="container">
        <div class="top_info_subpage_content">
            <p>category 90s</p>
        </div>
    </div>
</div>

<div id="main" class="clearfix">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                @if ( ! empty($category))
                <li class="breadcrumb-item active">{{ $category->name }}</li>
                @endif
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                @if ($files->count())
                @foreach($files as $file)
                <div class="cate_item">
                    <dl>
                        <dt>{{ $file->title }}</dt>
                        <dd>
                            <p class="title clearfix mb-0">
                            <span>Tracklist</span>
                            <span>{{ formatDayMonthYear($file->created_at) }}</span> </p>
                            <p class="content mb-0">{!! $file->track_list !!}</p>
                            <div class="box_action mb-0 clearfix">
                                <p class="action mb-0">
                                    @include('front.partial.download_button')
                                </p>
                                @include('front.partial.tags', ['fileId' => $file->id])
                            </div>
                        </dd>
                    </dl>
                </div>
                @endforeach
                <div class="pagination_item">
                    <nav aria-label="Page navigation example">
                        {{ $files->links() }}
                    </nav>
                </div>
                @endif
            </div>
            <div class="col-md-12 col-lg-4">
                @include('front.partial.category_menu')
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<link rel="stylesheet" href="{{ asset_admin('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
<script src="{{ asset_admin('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>

<script>

</script>
@endsection