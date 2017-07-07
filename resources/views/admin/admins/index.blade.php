@extends('admin.layouts.lumino')

@section('title', 'Danh sách quản trị viên')

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
		<h1 class="page-header">Quản trị viên</h1>
		<a href="{{url('admin/admins/create')}}" class="btn btn-primary btn-header"><i class="fa fa-plus"></i> &nbsp;&nbsp;Thêm quản trị viên</a>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-xs-12">
		@if(session('success'))
			<div class="alert bg-success" role="alert">
				<svg class="glyph stroked checkmark">
					<use xlink:href="#stroked-checkmark"></use>
				</svg> 
				{{session('success')}} 
				<a href="#" class="pull-right"><span class="fa fa-close"></span></a>
			</div>
		@endif
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách quản trị viên</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tài khoản</th>
				        <th>Họ tên</th>
				        <th class="center">Chi tiết</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($users as $user)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$user->id}}"></td>
				    			<td>
				    				<a href="{{url('admin/users/'.$user->id.'/edit')}}">{{$user->username}}</a>
				    			</td>
				    			<td>
				    				<strong>{{$user->name}}</strong>
				    			</td>
				    			<td class="center">
				    				<a href="{{url('admin/users/'.$user->id)}}"><i class="fa fa-close"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$users->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/users/destroy')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

