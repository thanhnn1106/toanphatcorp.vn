@extends("layouts.frontend.frontend_body_non_slider_and_categories")

@section('body')
    <div>
        <div class="row">
            <div class="form-group form-box">
                <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12 col-xs-push-0">

                    {{--Header--}}
                    <div class="form-header">
                        <span>{!! trans('reset_password.title') !!}</span>
                    </div>

                    {{--Body--}}
                    <div class="form-box-body">

                        <span>{!! trans('reset_password.description') !!}</span>

                        <p></p>

                        <form action="{{route('auth.reset_password')}}" method="POST">

                            {!! csrf_field() !!}

                            <input type="hidden" name="token" value="{{ $token }}">

                            {{--Email--}}
                            <div class="input-group mb-md">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                <input type="text" class="form-control" placeholder="{{ trans('reset_password.email') }}" name="email">
                            </div>
                            {{--New password--}}
                            <div class="input-group mb-md">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                <input class="form-control" placeholder="{{ trans('reset_password.new_password') }}" type="password" name="password">
                            </div>
                            {{--New password confirm--}}
                            <div class="input-group mb-md">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                <input class="form-control" placeholder="{{ trans('reset_password.confirm_new_password') }}" type="password"
                                       name="password_confirmation">
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
                                    <button type="submit" class="btn-reset btn btn-block btn-flat">{{ trans('reset_password.reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection