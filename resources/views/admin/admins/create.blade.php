@extends('admin.layouts.lumino')

@section('title', 'Thêm thành viên')


@section('body')
<div class="row">
	<ol class="breadcrumb">
		<li><a href="{{url('admin')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		@foreach($breadcrumps as $breadcrump)
			<li class="active">{!!isset($breadcrump['href'])?'<a href="'.$breadcrump['href'].'">'.$breadcrump['name'].'</a>':$breadcrump['name']!!}</li>
		@endforeach
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12 adm-header">
		<h1 class="page-header">Quản lý thành viên</h1>
		<a href="{{url('admin/users')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Xem tất cả</a>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm thành viên</div>
			<div class="panel-body">
				{{Form::open(['url' => 'admin/users'])}}

					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					    <label for="username" class="control-label">Tài khoản <span class="error">*</span></label>
				        {{Form::text('username',null,['class' => 'form-control', 'required' => '', 'autofocus' => ''])}}
				        @if ($errors->has('username'))
				            <span class="help-block">
				                <strong>{{ $errors->first('username') }}</strong>
				            </span>
				        @endif
				    </div> <!-- /.form-group -->

			    	<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			    	    <label for="password" class="control-label">Mật khẩu <span class="error">*</span></label>
			            {{Form::password('password',['class' => 'form-control'])}}
			            @if ($errors->has('password'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('password') }}</strong>
			                </span>
			            @endif
			        </div> <!-- /.form-group -->

		        	<div class="form-group{{ $errors->has('re_password') ? ' has-error' : '' }}">
		        	    <label for="re_password" class="control-label">Nhập lại mật khẩu <span class="error">*</span></label>
		                {{Form::password('re_password',['class' => 'form-control'])}}
		                @if ($errors->has('re_password'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('re_password') }}</strong>
		                    </span>
		                @endif
		            </div> <!-- /.form-group -->

		    		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		    		    <label for="name" class="control-label">Họ tên <span class="error">*</span></label>
		    	        {{Form::text('name',null,['class' => 'form-control', 'style' => 'max-width: 500px'])}}
		    	        @if ($errors->has('name'))
		    	            <span class="help-block">
		    	                <strong>{{ $errors->first('name') }}</strong>
		    	            </span>
		    	        @endif
		    	    </div> <!-- /.form-group -->

	            	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	            	    <label for="email" class="control-label">Email <span class="error">*</span></label>
	                    {{Form::email('email',null,['class' => 'form-control', 'style' => 'max-width:600px'])}}
	                    @if ($errors->has('email'))
	                        <span class="help-block">
	                            <strong class="error">{{ $errors->first('email') }}</strong>
	                        </span>
	                    @endif
	                </div> <!-- /.form-group -->

                	<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                	    <label for="image" class="control-label">Ảnh đại diện</label>
                        <div>
                        	<div class="image-container">
                        		{{Html::image('public/img/no-avatar.png',null, ['id' => 'holder'])}}
                        		<div class="brower" id="lfm" data-input="thumbnail" data-preview="holder">
                        			<span><i class="fa fa-upload"></i></span>
                        		</div>
                        		{{Form::text('image',null,['class' => 'form-control', 'id' => 'thumbnail'])}}
                        	</div>
                        </div>
                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div> <!-- /.form-group -->

		        	<div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">
		        	    <label for="student_code" class="control-label">Mã sinh viên</label>
		                {{Form::text('student_code',null, ['class' => 'form-control', 'style' => 'max-width:300px'])}}
		                @if ($errors->has('student_code'))
		                    <span class="help-block">
		                        <strong class="error">{{ $errors->first('student_code') }}</strong>
		                    </span>
		                @endif
		            </div> <!-- /.form-group -->

	            	<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	            	    <label for="phone" class="control-label">Số điện thoại</label>
	                    {{Form::text('phone',null,['class' => 'form-control', 'style' => 'max-width:300px'])}}
	                    @if ($errors->has('phone'))
	                        <span class="help-block">
	                            <strong class="error">{{ $errors->first('phone') }}</strong>
	                        </span>
	                    @endif
	                </div> <!-- /.form-group -->

                	<div class="form-group{{ $errors->has('story') ? ' has-error' : '' }}">
                	    <label for="story" class="control-label">Tiểu sử</label>
                        {{Form::textarea('story',old('story'))}}
                        @if ($errors->has('story'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('story') }}</strong>
                            </span>
                        @endif
                    </div> <!-- /.form-group -->

                    <button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Thêm thành viên</button>
				{{Form::close()}}
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	

@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('public/bower_components/tinymce/tinymce.min.js')}}"></script>
{{Html::script('public/vendor/laravel-filemanager/js/lfm.js')}}
<script type="text/javascript">
	tinymce.init({
	    selector: 'textarea[name="story"]',
	    height: 300
	});
	var domain = "{{ url('public/laravel-filemanager') }}";
	$('#lfm').filemanager('image',{prefix: domain});
</script>
@endsection