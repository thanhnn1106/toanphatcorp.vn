@extends('front.layout')
@section('content')
@include('notifications')
<div id="main" class="clearfix">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Packages</li>
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="alert alert-danger alert-block" style="display:none;">
            <p></p>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-8">
                @if(isset($packages) && $packages->count())
                <div class="price_content">
                    <h3>CÁC GÓI DỊCH VỤ</h3>
                    <div class="row">
                        @foreach($packages as $package)
                        <div class="col-md-4">
                            <dl>
                                <dt class="tt_01">{{ $package->name }}</dt>
                                <dd class="ct_01">
                                    <p>Price: <span>{{ formatCurrency($package->price) }}</span>VND</p>
                                    <p>{{ $package->description }}</p>
                                    <p>
                                        @include('front.partial.buy_button', ['package' => $package])
                                    </p>
                                </dd>
                            </dl>
                        </div>
                        @endforeach
                    </div>
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
<form id="formPackage" action="" method="POST">
    {{ csrf_field() }}
    <input type="hidden" id="packageId" name="packageId" />
    <input type="hidden" id="paymentMethod" name="paymentMethod" />
</form>
@endsection

@section('footer_script')
<script language="javascript" src="{{ asset_front('js/product.js?v='.time()) }}"></script>

@endsection