@extends("admin/dashboard")

@section('title')

@endsection


@section('content')
    <section>
        <div class="row">
            <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12 col-xs-push-0">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('change_password.title') }}</h3>
                    </div>
                    <form action="{{route('admin.change_password')}}" method="POST">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group mb-md">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="{{ trans('change_password.old_password') }}"
                                           name="old_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-md">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="{{ trans('change_password.new_password') }}"
                                           name="new_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-md">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="{{ trans('change_password.confirm_password') }}"
                                           name="new_password_confirmation">
                                </div>
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
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('change_password.change') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection