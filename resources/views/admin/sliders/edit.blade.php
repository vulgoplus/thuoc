@extends('admin.layouts.lumino')

@section('title', $slider->name)

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
		<h1 class="page-header">Slider</h1>
		<a href="{{url('admin/sliders')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Slider</a>
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
<div class="row">
	<div class="col-xs-12">
		@php $i = 1; @endphp
		@foreach($images as $image)
			<form class="panel panel-primary" method="POST" action="{{url('admin/sliders/update-image')}}" enctype='multipart/form-data'>
				{{csrf_field()}}
				<input type="hidden" name="id" value="{{$image->id}}">
				<input type="hidden" name="slider_id" value="{{$slider->id}}">
				<div class="panel-heading">
					#{{$i}}
					@php $i++; @endphp
				</div>
				<div class="panel-body">
					<div class="media">
					  	<div class="media-left">
					    	<img src="{{asset('public/'.$image->image)}}" class="media-object img-brower" style="width:200px">
					    	<input type="file" name="image" class="hidden slider-image" accept="image/*">
						</div>
						<div class="media-body">
						    <div class="form-group">
						    	{{Form::textarea('text',$image->text,['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Nội dung'])}}
						    </div>
						</div>
					</div>

					<div class="form-group">
						{{Form::text('link',$image->link,['class' => 'form-control', 'placeholder' => 'Liên kết'])}}
					</div>
				</div>
				<div class="panel-footer right">
					<button class="btn btn-warning">Lưu</button>
					<button class="btn btn-default delete-slider" type="button" data-url="{{url('admin/sliders/delete/'.$image->id)}}">Xóa</button>
				</div>
			</form>
		@endforeach

		<form class="panel panel-default" method="POST" action="{{url('admin/sliders/store-image')}}" enctype='multipart/form-data'>
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$slider->id}}">
			<div class="panel-heading">
				Thêm
			</div>
			<div class="panel-body">
				<div class="form-group">
					<button type="button" id="upload" class="btn btn-success">Tải lên</button>
					<div class="form-group"><img src="" id="img"></div>
					<input type="file" name="image" id="image-upload" class="hidden" accept="image/*">
					@if($errors->has('image'))
						<span class="error">{{$errors->first('image')}}</span>
					@endif
				</div>
				<div class="form-group">
					{{Form::textarea('text',null,['class' => 'form-control', 'placeholder' => 'Nội dung', 'rows' => 3])}}
				</div>
				<div class="form-group">
					{{Form::text('link',null,['class' => 'form-control', 'placeholder' => 'Liên kết'])}}
				</div>
			</div>
			<div class="panel-footer right">
				<button class="btn btn-primary">Thêm</button>
			</div>
		</form>
	</div>	
</div><!--/.row-->
<input type="hidden" id="url" value="{{url('admin')}}">
<input type="hidden" name="id" value="{{$slider->id}}">
@endsection

@push('scripts')
	{{Html::script('public/js/admin.js')}}
@endpush
