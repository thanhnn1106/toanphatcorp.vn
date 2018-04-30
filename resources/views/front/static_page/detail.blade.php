@extends('front.layout')
@section('content')
<!-- main start -->
    <div id="main" class="clearfix">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">About us</li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="aboutus_content">
                        {!! $pageDetail->content !!}
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    @include('front.partial.category_menu')
                </div>
            </div>
        </div>
    </div>
    <!-- main end --> 
@endsection

@section('footer_script')

<script>
</script>
@endsection
