@extends("layouts.frontend.frontend_body_non_slider_and_categories")

@section('body')

<section>
    <div class="row">
        <div class="form-group form-box">
            <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12 col-xs-push-0">

                {{--Header--}}
                <div class="form-header">
                    <span>{!!  trans('login_popup.login') !!}</span>
                </div>

                {{--Body--}}
                <div class="form-box-body">
                    <form action="{{route('auth.login')}}" method="POST">
                        {!! csrf_field() !!}

                        {{--Email--}}
                        <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            <input type="text" class="form-control" placeholder="{!!  trans('login_popup.email') !!}" name="email"
                                   value="{{old('email')}}">
                        </div>

                        {{--Password--}}
                        <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                            <input type="password" class="form-control" placeholder="{!!  trans('login_popup.password') !!}" name="password">
                        </div>
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
                            <div class="form-body-bottom">

                                <div class="col-md-6 col-xm-12 checkbox">
                                    <label class="pull-left">
                                        <input type="checkbox" value="">
                                        {!!  trans('login_popup.remember_me') !!}
                                    </label>
                                </div>

                                {{--Submit button--}}
                                <div class="col-md-6 col-xm-12">
                                    <button type="submit" class="btn-login btn btn-block btn-flat">{!!  trans('login_popup.login') !!}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="form-body-account-helper">
                        <a href="{{route('auth.forgot')}}">{!!  trans('login_popup.forgot_password') !!}</a><br>
                        <a href="{{route('auth.register')}}" class="text-center">{!!  trans('login_popup.new_register') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection