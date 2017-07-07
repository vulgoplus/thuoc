@extends('admin.layouts.lumino')

@section('title', 'Danh mục tin tức')

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
				{{Form::open(['url' => 'admin/taxonomies'])}}
					<div class="form-group">
						<label>Tiêu đề: </label>
						{{Form::text('name', null, ['class' => 'form-control', 'require' => ''])}}
						<span class="error">{{ $errors->has('name')?$errors->first('name'):'' }}</span>
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
				        <th>Ngày tạo</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($taxonomies as $taxonomy)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$taxonomy->id}}"></td>
				    			<td>
				    				<a href="{{url('admin/taxonomies/'.$taxonomy->id.'/edit')}}">{{$taxonomy->name}}</a>
				    			</td>
				    			<td>
				    				{{date('d/m/Y', strtotime($taxonomy->created_at))}}
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$taxonomies->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/taxonomies/delete')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

