@extends("auth.emails.html_master")

@section('message')

    <p>{!! trans('email_credit.dear', ['name' => $name]) !!}</p>
    <p>{!! trans('email_credit.text_1', ['siteName' => app('magbe.theme')->site_display_name]) !!}</p>

    <p>{!! trans('email_credit.text_2') !!}</p>
    <p>{!! trans('email_credit.text_3') !!}</p>
    <p>
        {!! trans('email_credit.text_4', ['siteName' => app('magbe.theme')->site_display_name]) !!}
        </p>
@endsection

@section('footer')
    {!! trans('global.mail_footer') !!}

@endsection

