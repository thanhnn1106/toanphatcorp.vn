@if(Auth::check())
    <a href="{{ route('front.purchase.send') }}" class="btn btn_03">Buy</a>
@else
    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn_03">Buy</a>
@endif