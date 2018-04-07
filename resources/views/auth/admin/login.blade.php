<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="{{ asset_admin('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset_admin('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset_admin('css/fontastic.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="{{ asset_admin('css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset_admin('css/style.default.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ asset_admin('css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset_admin('img/favicon.ico') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
            <div class="form-inner">
                <div class="logo text-uppercase"><span>CPANEL</span><strong class="text-primary">Dashboard</strong></div>
                <form id="login-form" action="{{route('admin.login')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group-material">
                        <input id="username" type="text" name="user_name" value="{{old('user_name')}}" class="input-material">
                        <label for="username" class="label-material">Username</label>
                        @if ($errors->has('user_name'))
                        <label class="error" for="register-username">{{ $errors->first('user_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group-material">
                        <input id="password" type="password" name="password" class="input-material">
                        <label for="password" class="label-material">Password</label>
                    </div>
                    <input type="submit" value="Login" class="btn btn-primary" />
                </form>
            </div>
        </div>
      </div>
    </div>
    <script src="{{ asset_admin('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset_admin('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset_admin('js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <!-- Main File-->
    <script src="{{ asset_admin('js/common.js') }}"></script>
  </body>
</html>