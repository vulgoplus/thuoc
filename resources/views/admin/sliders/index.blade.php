@extends('admin.layouts.lumino')

@section('title', 'Slider')

@section('content')
<div class="row">
	<ol class="breadcrumb">
		<li><a href="{{url('admin')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		@foreach($breadcrumps as $breadcrump)
			<li class="active">{{isset($breadcrump['href'])?'<a href="'.$breadcrump['href'].'">'.$breadcrump['name'].'</a>':$breadcrump['name']}}</li>
		@endforeach
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12 adm-header">
		<h1 class="page-header">Slider</h1>
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
	<div class="col-md-5 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Thêm slider</div>
			<div class="panel-body">
				{{Form::open(['url' => 'admin/sliders'])}}
					<div class="form-group">
						<label>Tên: </label>
						{{Form::text('name', null, ['class' => 'form-control', 'require' => ''])}}
						<span class="error">{{ $errors->has('name')?$errors->first('name'):'' }}</span>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Thêm</button>
					</div>
				{{Form::close()}}
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>

	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tên</th>
				        <th class="center">Chức năng</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($sliders as $slider)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$slider->id}}"></td>
				    			<td>
				    				<a href="{{url('admin/sliders/'.$slider->id)}}">{{$slider->name}}</a>
				    			</td>
				    			<td class="center">
				    				<a href="{{url('admin/sliders/'.$slider->id)}}"><i class="fa fa-pencil-square-o"></i></a>
				    				<a href="{{url('admin/sliders/'.$slider->id)}}" class="delete"><i class="fa fa-close"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$sliders->render()}}
				</div>
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

