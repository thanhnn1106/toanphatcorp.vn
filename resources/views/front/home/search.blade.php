@extends('front.layout')
@section('content')
<div id="main" class="clearfix">
    <div class="container">
        <div class="row">
            SEARCH RESULTS FOR: {{ $keyword or null }}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                @if ($files->count())
                @foreach($files as $file)
                    <?php $coverImage = $file->getCoverImageUrl(); ?>
                <div class="cate_item">
                    <dl>
                        <dt style="@if( ! empty($coverImage)) background:url('{{ $coverImage }}') @endif">{{ $file->title }}</dt>
                        <dd>
                            <p class="title clearfix mb-0">
                            <span>Tracklist</span>
                            <span>{{ formatDayMonthYear($file->created_at) }}</span> </p>
                            <div class="content mb-0">{!! $file->track_list !!}</div>
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

@endsection