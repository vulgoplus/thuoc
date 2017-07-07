@extends('admin.layouts.lumino')

@section('title', 'Cập nhật danh mục')

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
		<h1 class="page-header">Danh mục sản phẩm</h1>
		<a href="{{url('admin/categories')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Danh sách danh mục</a>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-xs-12">
		@if(session('success'))
			<div class="alert bg-success alert-dismissable" role="alert">
				<svg class="glyph stroked checkmark">
					<use xlink:href="#stroked-checkmark"></use>
				</svg> 
				{{session('success')}} 
				<a href="#" class="pull-right" data-dismiss="alert" aria-label="close"><span class="fa fa-close"></span></a>
			</div>
		@endif
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách danh mục</div>
			<div class="panel-body">
				{{Form::model($category, ['url' => 'admin/categories/'.$category->id, 'method' => 'put'])}}
					<input type="hidden" name="id" value="{{$category->id}}">
					<div class="form-group">
						<label>Tiêu đề: </label>
						{{Form::text('name', null, ['class' => 'form-control', 'require' => ''])}}
						<span class="error">{{ $errors->has('name')?$errors->first('name'):'' }}</span>
					</div>
					<div class="form-group">
						<label>Loại: </label>
						<select name="parent" class="form-control" style="max-width: 400px;">
							<option value="1" {{$category->parent==1?'selected':''}}>Thời trang nam</option>
							<option value="2" {{$category->parent==2?'selected':''}}>Thời trang nữ</option>
							<option value="3" {{$category->parent==3?'selected':''}}>Phụ kiện</option>
						</select>
					</div>
					<button class="btn btn-primary">Cập nhật</button>
				{{Form::close()}}
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	

@endsection
