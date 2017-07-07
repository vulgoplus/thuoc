@extends('admin.layouts.lumino')

@section('title', 'Cập nhật tin tức')

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
		<h1 class="page-header">Sản phẩm</h1>
		<a href="{{url('admin/posts')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Danh sách tin tức</a>
	</div>
</div><!--/.row-->
@if(session('success'))
	<div class="alert bg-success alert-dismissable" role="alert">
		<svg class="glyph stroked checkmark">
			<use xlink:href="#stroked-checkmark"></use>
		</svg> 
		{{session('success')}} 
		<a href="#" class="pull-right" data-dismiss="alert" aria-label="close"><span class="fa fa-close"></span></a>
	</div>
@endif
{!!Form::model($post,['url' => 'admin/posts/'.$post->id, 'files' => true, 'method' => 'put'])!!}
<input type="hidden" name="id" value="{{$post->id}}">
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">Thông tin cơ bản</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Tiêu đề <span class="error">*</span>: </label>
					{{Form::text('title', null, ['class' => 'form-control', 'id' => 'post-title', 'autofocus' => ''])}}
					<span id="slug" class="hidden" style="display: block;"></span>
					<input type="hidden" name="slug" value="{{$post->slug}}">
					<span class="error">{{$errors->has('title')?$errors->first('title'):''}}</span>
				</div>

				<div class="form-group">
					<label>Nội dung: </label>
					{{Form::textarea('content', null)}}
					<span class="error">{{$errors->has('content')?$errors->first('content'):''}}</span>
				</div>
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->

		<div class="panel panel-default">
			<div class="panel-heading">
				Thẻ
			</div>
			<div class="panel-body">
				<div class="form-group">
					{{Form::text('tags', null, ['class' => 'form-control'])}}
					Các thẻ cách nhau bằng dấu ","
				</div>
			</div> {{-- /.panel-body --}}
		</div> {{-- /.panel-default --}}
	</div> {{-- /.col-md-8 --}}

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Ảnh đại diện <span class="error">*</span>
			</div>
			<div class="panel-body">
				<div class="img">
					{{Html::image('public/'.$post->image,'Ảnh đại diện',['id' => 'img'])}}
					<div class="btn-upload">
						{{Form::file('image', ['accept' => 'image/*', 'id' => 'image'])}}
						<i class="fa fa-upload fa-2x"></i>
					</div>
				</div>
				<span class="error">{{$errors->has('image')?$errors->first('image'):''}}</span>
			</div> {{-- /.panel-body --}}
		</div> {{-- /.panel-default --}}
		<div class="panel panel-default">
			<div class="panel-heading">
				Danh mục
			</div>
			<div class="panel-body">
				<div class="form-group">
					<select name="taxonomy_id" class="form-control" style="max-width: 500px">
						@foreach($taxonomies as $taxonomy)
							<option value="{{$taxonomy->id}}" {{$taxonomy->id==$post->taxonomy_id?'selected':''}}>{{$taxonomy->name}}</option>
						@endforeach
					</select>
				</div>
				<div id="add_taxonomy">
					<div class="form-group collapse">
						<input type="text" id="taxonomy_name" onkeypress="return event.keyCode != 13;" placeholder="Tên danh mục" class="form-control">
					</div>
					<button type="button" class="btn btn-warning" id="btn_add_taxonomy">Thêm</button>
					<button type="button" class="btn btn-default collapse" id="btn_cancel">Hủy</button>
				</div>
			</div> {{-- /.panel-body --}}
		</div> {{-- /.panel-default --}}

		<button class="btn btn-primary">Cập nhật</button>
	</div> {{-- /.col-md-4 --}}
</div><!--/.row-->
{!!Form::close()!!}
<input type="hidden" id="url" value="{{url('admin')}}">
@endsection

@push('scripts')
	{{Html::script('public/bower_components/tinymce/tinymce.min.js')}}
	{{Html::script('public/js/admin.js')}}
	<script type="text/javascript">
		var editor_config = {
		    path_absolute : "{{url('public')}}/",
		    selector: 'textarea[name="content"]',
		    height: 400,
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