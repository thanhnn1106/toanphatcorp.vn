@if($isLogged)
    <a href="javascript:void(0);" 
       package-id="{{ isset($package->id) ? $package->id : '' }}" payment-method="{{ config('site.payment_method.value.VISA') }}"
       data-url="{{ route('front.purchase.send') }}"
       class="btn btn_03 buy-budget">Buy Internet Banking</a>

       <a href="javascript:void(0);" 
       package-id="{{ isset($package->id) ? $package->id : '' }}" payment-method="{{ config('site.payment_method.value.IB_ONLINE') }}"
       data-url="{{ route('front.purchase.send') }}"
       class="btn btn_03 buy-budget">VISA</a>
@else
    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn_03">Login</a>
@endif