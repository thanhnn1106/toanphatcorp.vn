@extends('front.layout')
@section('content')
<!-- main start -->
    <div id="main" class="clearfix">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="aboutus_content">
                        <h1>Your message was sent successfully.</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    @include('front.partial.category_menu')
                    @include('front.partial.calendar')
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
