@extends('front.layout')
@section('content')
<div id="main" class="clearfix">
    <div class="top_info_subpage">
        <div class="container">
            <div class="top_info_subpage_content">
                <p>F.A.Q</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">FAQs</li>
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                @if ($faqs->count() <= 0)
                <h5>No data found.</h5>
                @else
                <div class="faq_content">
                    @foreach($faqs as $faq)
                    <h5 class="title">{{ $faq->question }}</h5>
                    <p class="content">{{ $faq->answer }}</p>
                    @endforeach
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
