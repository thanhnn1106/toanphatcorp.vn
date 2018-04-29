@extends('front.layout')
@section('content')

<div class="center">
    <h3>Yêu cầu nạp tiền</h3>
    <input class="button" type="button" style="display:none;" id="btn_payment" value="Nạp tiền" />
</div>

@endsection

@section('footer_script')

<script language="javascript" src="{{ asset_front('js/nganluong.apps.mcflow.js') }}"></script>
<script language="javascript">
var urlProcess = '{{ $linkCheckout }}';

$('#btn_payment').on('click', function (event, url) {
    var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'btn_payment',url: url});
});

if (urlProcess !== '') {
    $( "#btn_payment" ).trigger( "click" );
}
</script>
@endsection