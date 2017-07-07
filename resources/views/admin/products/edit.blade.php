@extends('admin.layouts.lumino')

@section('title', 'Cập nhật sản phẩm')

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
		<a href="{{url('admin/products')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Danh sách sản phẩm</a>
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
{!!Form::model($product,['url' => 'admin/products/'.$product->id, 'files' => true, 'method' => 'put'])!!}
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">Thông tin cơ bản</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Tên sản phẩm <span class="error">*</span>: </label>
					{{Form::text('title', null, ['class' => 'form-control'])}}
					<span id="slug" class="hidden" style="display: block;"></span>
					<input type="hidden" name="slug" value="{{$product->slug}}">
					<span class="error">{{$errors->has('title')?$errors->first('title'):''}}</span>
				</div>

				<div class="form-group">
					<label>Mô tả ngắn: </label>
					{{Form::textarea('short_description', null)}}
					<span class="error">{{$errors->has('short_description')?$errors->first('short_description'):''}}</span>
				</div>

				<div class="form-group">
					<label>Mô tả: </label>
					{{Form::textarea('description', null)}}
					<span class="error">{{$errors->has('description')?$errors->first('description'):''}}</span>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Giá (đ) <span class="error">*</span>: </label>
							{{Form::text('price', null, ['class' => 'form-control'])}}
							<span class="error">{{$errors->has('price')?$errors->first('price'):''}}</span>
						</div>
						<div class="col-md-6">
							<label>Giảm giá (đ): </label>
							{{Form::text('sale', null, ['class' => 'form-control'])}}
							<span class="error">{{$errors->has('sale')?$errors->first('sale'):''}}</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Nơi sản xuất: </label>
					{{Form::text('maded', null, ['class' => 'form-control'])}}
				</div>
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div> {{-- /.col-md-8 --}}

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Ảnh đại diện
			</div>
			<div class="panel-body">
				<div class="img">
					{{Html::image('public/'.$product->image,'Ảnh đại diện',['id' => 'img'])}}
					<div class="btn-upload">
						{{Form::file('image', ['accept' => 'image/*', 'id' => 'image'])}}
						<i class="fa fa-upload fa-2x"></i>
					</div>
				</div>
				<span class="error">{{$errors->has('image')?$errors->first('image'):''}}</span>

				<div class="form-group" style="margin-top: 15px">
					<label>Ảnh phụ</label>
					<div class="images">
						<button type="button" id="btn-images" class="btn btn-warning">Chọn ảnh</button>
						<input type="file" name="images[]" multiple id="images">
						<span id="images-alert"></span>
					</div>
				</div>
			</div> {{-- /.panel-body --}}
		</div> {{-- /.panel-default --}}
		<div class="panel panel-default">
			<div class="panel-heading">
				Danh mục
			</div>
			<div class="panel-body">
				<div class="form-group">
					<select name="category_id" class="form-control" style="max-width: 500px">
						@foreach($categories as $category)
							<option value="{{$category->id}}" {{$product->category_id==$category->id}}>{{$category->name}}</option>
						@endforeach
					</select>
				</div>
				<div id="add_category">
					<div class="form-group collapse">
						<input type="text" id="category_name" onkeypress="return event.keyCode != 13;" placeholder="Tên danh mục" class="form-control">
						<select name="parent" class="form-control" style="margin-top: 5px">
							<option value="1">Thời trang nam</option>
							<option value="2">Thời trang nữ</option>
							<option value="3">Phụ kiện</option>
						</select>
					</div>
					<button type="button" class="btn btn-warning" id="btn_add_category">Thêm</button>
					<button type="button" class="btn btn-default collapse" id="btn_cancel">Hủy</button>
				</div>
			</div> {{-- /.panel-body --}}
		</div> {{-- /.panel-default --}}

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

		<button class="btn btn-primary">CẬP NHẬT</button>
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
		    selector: 'textarea[name="description"]',
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
		tinymce.init({
			selector: 'textarea[name="short_description"]'
		});
	</script>	
@endpush