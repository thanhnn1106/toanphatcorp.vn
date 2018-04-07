@extends("auth.emails.html_master")

@section('message')

    <p>{!! trans('email_subcription.congratulations', ['name' => $name]) !!}</p>
    <p>{!! trans('email_subcription.text_1', ['siteName' => app('magbe.theme')->site_display_name, 'expiredDate' => $expiredDate]) !!}</p>

    <p>{!! trans('email_subcription.text_2') !!}</p>
    <p>{!! trans('email_subcription.text_3') !!}</p>
    <p>
        {!! trans('email_subcription.text_4', ['siteName' => app('magbe.theme')->site_display_name]) !!}
        </p>
@endsection

@section('footer')
    {!! trans('global.mail_footer') !!}

@endsection

