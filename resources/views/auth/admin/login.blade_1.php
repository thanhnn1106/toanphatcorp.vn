<html>
<head></head>
<body>
<section>
  <div class="row">
    <div class="form-group form-box">
      <div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12 col-xs-push-0">

        <div class="form-header">
          <span>Login</span>
        </div>

        <div class="form-box-body">
          <form action="{{route('admin.login')}}" method="POST">
            {{ csrf_field() }}

            {{--Email--}}
            <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
              <input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" value="{{old('user_name')}}">
            </div>

            {{--Password--}}
            <div class="input-group mb-md">
              <span class="input-group-addon">
                  <i class="fa fa-key"></i>
              </span>
              <input type="password" class="form-control" placeholder="Password" name="password">
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
                <div class="col-md-6 col-xm-12">
                  <button type="submit" class="btn-login btn btn-block btn-flat">Login</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
