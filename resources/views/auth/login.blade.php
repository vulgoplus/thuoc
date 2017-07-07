<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng nhập</title>
    <!-- Styles -->
    {{Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}
    {{Html::style('public/bower_components/awesome/css/font-awesome.min.css')}}
    {{Html::style('public/css/login.css')}}
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div class="form-login">
    <h2>Đăng nhập</h2>
    <form role="form" method="POST" action="{{ url('/register') }}">
        {{csrf_field()}}
        <div class="form-group">
            <div class="control">
                <input type="text" name="username" placeholder="Tên đăng nhập">
                <i class="fa fa-user"></i>
            </div>
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="control">
                <input type="password" name="password" placeholder="Mật khẩu">
                <i class="fa fa-lock"></i>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <label><input type="checkbox" name="remember"> Nhớ mật khẩu</label>
        <button>Đăng nhập</button>
    </form>
    <a href="{{url('auth/facebook')}}" class="social social-facebook"><i class="fa fa-facebook"></i>Đăng nhập bằng Facebook</a>
    <a href="{{url('auth/google')}}" class="social social-google"><i class="fa fa-google-plus"></i>Đăng nhập bằng G+</a>
    <div style="text-align: center; margin-top: 15px;">
        <a href="{{url('register')}}">Đăng ký tài khoản mới!</a>
    </div>
</div>
</body>
</html>