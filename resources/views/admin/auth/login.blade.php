<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Đăng nhập</title>

{{Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}
{{Html::style('public/lumino/css/styles.css')}}

<!--[if lt IE 9]>
{{Html::script('public/lumino/js/html5shiv.js')}}
{{Html::script('public/lumino/js/respond.min.js')}}
<![endif]-->

</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Đăng nhập</div>
				<div class="panel-body">
					<form role="form" action="{{url('admin/login')}}" method="POST">
						{{csrf_field()}}
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Tài khoản" name="username" type="text" autofocus="">
								@if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
								@if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ mật khẩu
								</label>
							</div>
							<button class="btn btn-primary">Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
