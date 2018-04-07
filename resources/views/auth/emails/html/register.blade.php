@extends("auth.emails.html_master")

@section('message')

    <p>{!! trans('email_verify.dear', ['name' => $name]) !!}</p>
    <p>{!! trans('email_verify.text_1', ['siteName' => $site_name, 'url' => route('auth.activate', $token)]) !!}</p>
    <p>
        {!! trans('email_verify.text_2', ['siteName' => $site_name]) !!}
        </p>
@endsection

@section('footer')
    {!! trans('global.mail_footer') !!}

@endsection

