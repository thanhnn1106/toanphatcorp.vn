@if(Auth::check())
    <a href="javascript:void(0);" 
       package-id="{{ isset($package->id) ? $package->id : '' }}" 
       data-url="{{ route('front.purchase.send') }}"
       class="btn btn_03 buy-budget">Buy</a>
@else
    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn_03">Login</a>
@endif