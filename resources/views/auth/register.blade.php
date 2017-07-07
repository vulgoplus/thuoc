<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng ký</title>
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
    <h2>Đăng ký</h2>
    <form role="form" method="POST" action="{{ url('/register') }}">
        {{csrf_field()}}
        <div class="form-group">
            <div class="control-signup">
                <input type="text" name="name" placeholder="Họ tên">
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="control-signup">
                <input type="text" name="username" placeholder="Tên đăng nhập">
            </div>
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="control-signup">
                <input type="email" name="email" placeholder="Email">
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="control-signup">
                <input type="password" name="password" placeholder="Mật khẩu">
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="control-signup">
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="control-signup">
            <p>{!!captcha_img()!!}</p>
                <input type="text" name="captcha" placeholder="Nhập mã">
            </div>
            @if ($errors->has('captcha'))
                <span class="help-block">
                    <strong>{{ $errors->first('captcha') }}</strong>
                </span>
            @endif
        </div>
        <button>Đăng ký</button>
    </form>
    <a href="{{url('auth/facebook')}}" class="social social-facebook"><i class="fa fa-facebook"></i>Đăng nhập bằng Facebook</a>
    <a href="{{url('auth/google')}}" class="social social-google"><i class="fa fa-google-plus"></i>Đăng nhập bằng G+</a>
</div>
</body>
</html>