@extends('admin.layouts.lumino')

@section('title', 'Danh mục sản phẩm')

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
		<h1 class="page-header">Danh mục</h1>
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
			<div class="panel-heading">Thêm danh mục</div>
			<div class="panel-body">
				{{Form::open(['url' => 'admin/categories'])}}
					<div class="form-group">
						<label>Tiêu đề: </label>
						{{Form::text('name', null, ['class' => 'form-control', 'require' => ''])}}
						<span class="error">{{ $errors->has('name')?$errors->first('name'):'' }}</span>
					</div>
					<div class="form-group">
						<label>Loại: </label>
						<select name="parent" class="form-control" style="max-width: 400px;">
							<option value="1">Thời trang nam</option>
							<option value="2">Thời trang nữ</option>
							<option value="3">Phụ kiện</option>
						</select>
					</div>
					<button class="btn btn-primary">THÊM DANH MỤC</button>
				{{Form::close()}}
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>

	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-heading">Danh mục sản phẩm</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tên danh mục</th>
				        <th class="center">Ngày tạo</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($categories as $category)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$category->id}}"></td>
				    			<td>
				    				<a href="{{url('admin/categories/'.$category->id.'/edit')}}">{{$category->name}}</a>
				    			</td>
				    			<td class="center">
				    				<a href="{{url('admin/categories/'.$category->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
				    				<a href="{{url('admin/categories/'.$category->id)}}" class="delete"><i class="fa fa-close"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$categories->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/categories/destroy')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

