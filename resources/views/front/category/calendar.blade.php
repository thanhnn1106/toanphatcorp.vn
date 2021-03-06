@extends('front.layout')
@section('content')
<div id="main" class="clearfix">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Calendar</li>
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                @if ($files->count() <= 0)
                <h5>No data found.</h5>
                @else
                @foreach($files as $file)
                <?php $coverImage = $file->getCoverImageUrl(); ?>
                <div class="cate_item">
                    <dl>
                        <dt style="background:url('{{ $coverImage }}')">
                            <a href="{{ route('front.file_detail', ['slug' => $file->slug]) }}">
                                {{ $file->getTitleWithDate() }}
                            </a>
                        </dt>
                        <dd>
                            <p class="title clearfix mb-0">
                            <span><strong>Tracklist</strong></span>
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
                @include('front.partial.calendar_menu')
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')

@endsection
