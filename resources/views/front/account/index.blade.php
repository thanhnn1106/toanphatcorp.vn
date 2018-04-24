@extends('front.layout')
@section('content')
<div id="main" class="clearfix">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">User info</li>
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="info">
                    <table class="tb_01 tb_block">
                        <tr>
                            <th class="w10">Provider:</th>
                            <td>{{ $user->provider }}</td>
                        </tr>
                        @if( ! empty($user->avatar))
                        <tr>
                            <th class="w10">Avatar:</th>
                            <td>
                                <a href="{{ $user->avatar }}" target="_blank">
                                    <img src="{{ $user->avatar }}" />
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if( ! empty($user->full_name))
                        <tr>
                            <th class="w10">Your name:</th>
                            <td>{{ $user->full_name }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Your email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
                </div>
                <p class="title_01">Lịch sử giao dịch</p>
                <div class="history">
                    <table class="tb_01 tb_block mb-2">
                        <tr>
                            <td class="w10">02/04/2018</td>
                            <td>Partybreaks And Remixes</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                @include('front.partial.category_menu')
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')

<script>
</script>
@endsection