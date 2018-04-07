@extends("auth.emails.html_master")

@section('message')

    <p>Dear {{ isset($user->display_name) ? $user->display_name : 'client' }},
        <br><br>
        Your email has been registered as a publisher by Magbe Admin.</p>

    <br><br>
    Your account:<br>
    - Email: {{ $user->email }}
    - Password: {{ $password }}

    You can <a href="{{ route('auth.reset_password', ['token'=>$token]) }}" target="_blank">Click
        here</a> to login and access <a href="{{ route('admin', ['token'=>$token]) }}" target="_blank">Admin page</a> to manage your articles from now.
    <br><br>

    <p>
        Best,<br>
        Magbe Team
    </p>
@endsection

@section('footer')
    For more information visit: <a href="{{ route('frontend.home') }}" target="_blank">{{ route('frontend.home') }}</a>

@endsection

