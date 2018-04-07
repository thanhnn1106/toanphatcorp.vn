@extends("auth.emails.html_master")

@section('message')

    <p>Dear {{ isset($user->display_name) ? $user->display_name : 'client' }},
        <br><br>
        It looks like you forgot your password or it isn't working. Don't worry, we've got you covered because there's
        enough to worry about other than forgotten passwords.</p>

    So just <a href="{{ route('admin.auth.reset_form', ['token'=>$token]) }}" target="_blank">Click here</a> to reset your password.
    <br><br>

    <p>
        Best,<br>
        Magbe Team
    </p>
@endsection

@section('footer')
    For more information visit: <a href="{{ route('frontend.home') }}" target="_blank">{{ route('frontend.home') }}</a>

@endsection

