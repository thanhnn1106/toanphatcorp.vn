@extends("layouts.frontend.frontend_body_non_slider_and_categories")

@section('body')

<section>
    <div class="row">
        <div class="form-group form-box">
            <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12 col-xs-push-0">

                {{--Header--}}
                <div class="form-header">
                    <span>Forgot your password?</span>
                </div>

                {{--Body--}}
                <div class="form-box-body">

                    <span>Enter your registered email address and we'll send you a link allowing you to reset your password.</span>

                    <p></p>

                    <form action="{{route('admin.auth.forgot')}}" method="POST">
                        {!! csrf_field() !!}

                        {{--Email--}}
                        <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            <input type="text" class="form-control" placeholder="Your email" name="email" id="email">
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success status-alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn-reset btn btn-block btn-flat">Send Email</button>
                            </div>
                        </div>
                    </form>

                    <div class="form-body-account-helper">
                        <a href="{{route('admin.auth.login')}}">Back to login</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection