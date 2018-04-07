@extends("layouts.frontend.frontend_body_non_slider_and_categories")

@section('body')

    <div>
        <div class="row">
            <div class="form-group form-box">
                <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12 col-xs-push-0">

                    {{--Header--}}
                    <div class="form-header">
                        <span>{!! trans('register_popup.register') !!}</span>
                    </div>

                    {{--Body--}}
                    <div class="form-box-body">
                        <form action="{{route('auth.register')}}" method="POST">
                            {!! csrf_field() !!}

                            {{--Name--}}
                            <div class="mb-md">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="{!! trans('register_popup.name') !!}" name="name"
                                           value="{{old('name')}}">
                                </div>
                            </div>

                            {{--Email--}}
                            <div class="mb-md">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="{!! trans('register_popup.email') !!}" name="email"
                                           value="{{old('email')}}">
                                </div>
                            </div>

                            {{--Password--}}
                            <div class="mb-md">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="{!! trans('register_popup.password') !!}" name="password">
                                </div>
                            </div>

                            {{--Password Confirmation--}}
                            <div class="mb-md">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="{!! trans('register_popup.confirm_password') !!}"
                                           name="password_confirmation">
                                </div>
                            </div>

                            {{--Promo code--}}
                        @if(isset($withPromo) && $withPromo == 1)
                            <div class="mb-md">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-gift"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Promo Code"
                                           name="promo_code" value="">
                                </div>
                            </div>
                        @endif

                            <div class="input-group mb-md">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
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
                                    {{--Submit button--}}
                                    <div class="col-md-12 col-xm-12 btn-register">
                                        <button type="submit" class="btn-login btn btn-block btn-flat">{!! trans('register_popup.register') !!}</button>
                                    </div>
                                    <div class="col-md-12 col-xm-12">
                                        <a href="{{route('auth.login')}}">{!! trans('register_popup.back') !!}</a><br>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection