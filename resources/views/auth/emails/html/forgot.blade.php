@extends("auth.emails.html_master")

@section('message')

    <p>{!! trans('email_forgot_password.dear', ['name' => isset($user->display_name) ? $user->display_name : 'client']) !!}
        <br><br>
        {!! trans('email_forgot_password.text_1') !!}</p>

    {!! trans('email_forgot_password.text_2', ['url' => route('auth.reset_form', ['token'=>$token])]) !!}
    <br><br>

    <p>
        {!! trans('email_forgot_password.text_3', ['siteName' => app('magbe.theme')->site_display_name]) !!}
    </p>
@endsection

@section('footer')
    {!! trans('global.mail_footer') !!}

@endsection

