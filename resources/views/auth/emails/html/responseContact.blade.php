@extends("auth.emails.html_master")

@section('message')

    <p>{!! trans('email_response_contact.dear', ['name' => isset($name) ? $name : 'client']) !!}
        <br><br>
        {!! trans('email_response_contact.text_1') !!}</p>
    <br>

    <p>
        {!! trans('email_response_contact.text_2') !!}<br>
        {{app('magbe.theme')->site_display_name}} {!! trans('email_response_contact.text_3') !!}
    </p>
@endsection

@section('footer')
    {!! trans('global.mail_footer') !!}

@endsection

