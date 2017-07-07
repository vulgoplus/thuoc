@extends('admin.layouts.lumino')

@section('title', 'Trang')

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
		<h1 class="page-header">Trang</h1>
		<a href="{{url('admin/pages/create')}}" class="btn btn-primary btn-header"><i class="fa fa-plus"></i> &nbsp;&nbsp;Thêm trang</a>
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
				<a href="#" class="pull-right close" data-dismiss="alert"><span class="fa fa-close"></span></a>
			</div>
		@endif
		<div class="panel panel-default">
			<div class="panel-heading">Tất cả các trang</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Trang</th>
				    	<th>Chuỗi</th>
				        <th class="center">Thao tác</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($pages as $page)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$page->id}}"></td>
				    			<td>
				    				<a href="{{url('admin/pages/'.$page->id.'/edit')}}">{{$page->title}}</a>
				    			</td>
				    			<td>{{$page->slug}}</td>
				    			<td class="center">
				    				<a href="{{url('trang/'.$page->slug)}}" target="_blank" data-toggle="tooltip" title="Xem trước"><i class="fa fa-bullseye"></i></a>
				    				<a href="{{url('admin/pages/'.$page->id.'/edit')}}" data-toggle="tooltip" title="Sửa"><i class="fa fa-pencil-square-o"></i></a>
				    				<a href="{{url('admin/pages/'.$page->id)}}" class="delete" data-toggle="tooltip" title="Xóa"><i class="fa fa-remove"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$pages->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/pages/delete')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

