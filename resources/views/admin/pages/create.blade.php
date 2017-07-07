@extends('admin.layouts.lumino')

@section('title', 'Thêm trang')

@section('content')
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
		<h1 class="page-header">Trang</h1>
		<a href="{{url('admin/pages')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Xem tất cả</a>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm bản tin</div>
			<div class="panel-body">
				{{Form::open(['url' => 'admin/pages'])}}
					<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					    <label for="title" class="control-label">Tiêu đề <span class="error">*</span></label>
				        {{Form::text('title',null,['class' => 'form-control', 'required' => '', 'autofocus' => ''])}}
				        @if ($errors->has('title'))
				            <span class="help-block">
				                <strong>{{ $errors->first('title') }}</strong>
				            </span>
				        @endif
				    </div> <!-- /.form-group -->

                	<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                	    <label for="content" class="control-label">Nội dung <span class="error">*</span></label>
                	    	{{Form::textarea('content')}}                        	
                        </textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div> <!-- /.form-group -->

                    <button class="btn btn-primary">Thêm trang</button>
				{{Form::close()}}
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('public/bower_components/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
	var editor_config = {
	    path_absolute : "{{url('public')}}/",
	    selector: 'textarea[name="content"]',
	    height: 300,
	    plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
	    relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      	var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      	var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      	var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      	if (type == 'image') {
	        	cmsURL = cmsURL + "&type=Images";
	      	} else {
	        	cmsURL = cmsURL + "&type=Files";
	      	}

	      	tinyMCE.activeEditor.windowManager.open({
	        	file : cmsURL,
	        	title : 'Quản lý tệp tin',
	        	width : x * 0.8,
	        	height : y * 0.8,
	        	resizable : "yes",
	        	close_previous : "no"
	      });
	    }
	};

	tinymce.init(editor_config);
</script>
@endpush