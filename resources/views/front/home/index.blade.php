@extends('front.layout')
@section('content')
@include('notifications')
<div class="top_info">
    <div class="container">
        <div id="slider">
            <div>
                <p class="mb-0"><img src="{{ asset_front('images/slider_01.jpg') }}" alt="img"></p>
            </div>
            <div>
                <p class="mb-0"><img src="{{ asset_front('images/slider_02.jpg') }}" alt="img"></p>
            </div>
            <div>
                <p class="mb-0"><img src="{{ asset_front('images/slider_03.jpg') }}" alt="img"></p>
            </div>
        </div>
        <div class="top_info_content">
            <h2>
              <span class="h2_01">MUSIC IS YOUR</span>
              <span class="h2_02">dj-compilations</span>
              <span class="h2_03">DJ Compilations is one of the best<br>DJ Pool Exchange on the web.</span>
            </h2>
            <ul class="clearfix box_btn">
                <li><a href="#title_about" class="btn btn_02">About us</a></li>
                <li><a href="" class="btn btn_03">Download</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- main start -->
    <div id="main" class="clearfix">
        <div class="container-fluid"> 
            <!-- main_box_01 start -->
            <div class="main_box_01">
                <div class="inner clearfix">
                    <div class="container">
                        <p class="title_01" id="title_about">about us</p>
                        <p class="content">Our service is strictly for DJs only!<br>
                            This is because the promotional edits contained here are specially edited for DJs to play.<br>
                            It is important that these promo tracks and videos do not get in the general domain.</p>
                        <p><a href="#" class="btn btn_03">read more</a></p>
                    </div>
                </div>
            </div>
            <!-- main_box_01 end --> 
        </div>
        
        <!-- main_box_02 start -->
        <div class="main_box_02">
            @include('front.partial.category_slide')
        </div>
        <!-- main_box_02 end --> 
        
        <!-- main_box_03 start -->
        <div class="main_box_03">
            <div class="container-fluid">
                <div class="inner clearfix">
                    <div class="container">
                        <div class="box_03_content">
                            <p class="title">new hot list</p>
                            <p class="content">All In One Partybreaks and Remixes [February 2018] Part. 6</p>
                            <p><a href="" class="btn btn_03">download</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- main_box_03 end --> 
        </div>
        
        <!-- main_box_04 start -->
        <div class="main_box_04">
            <div class="container">
                <div class="inner clearfix">
                    <div class="box_04_content clearfix">
                        <div class="row">
                            @if(isset($files) && $files->count())
                            @foreach($files as $file)
                            <div class="col-xs-6 col-md-4 col-lg-3">
                                <div class="item">
                                    <?php $thumbnail = $file->getThumbnailUrl(); ?>
                                    @if( ! empty($thumbnail))
                                    <p class="item_img">
                                        <img src="{{ $thumbnail }}" alt="img">
                                    </p>
                                    @endif
                                    <p class="item_ct">
                                        <span>
                                            <a href="{{ route('front.file_detail', ['slug' => $file->slug]) }}">
                                                {{ $file->getTitleWithDate() }}
                                            </a>
                                        </span>
                                        <span>{{ formatMonthYear($file->created_at) }}</span>
                                        @include('front.partial.download_button', ['file' => $file])
                                    </p>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main_box_04 end --> 
        
    </div>
@endsection

@section('footer_script')

<script>
</script>
@endsection
