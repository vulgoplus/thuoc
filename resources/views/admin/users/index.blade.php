@extends('admin.layouts.lumino')

@section('title', 'Người dùng')

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
		<h1 class="page-header">Người dùng</h1>
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
			<div class="panel-heading">Danh sách người dùng</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tài khoản</th>
				        <th>Họ tên</th>
				        <th>Email</th>
				        <th class="center">Chức năng</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($users as $user)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$user->id}}"></td>
				    			<td>
				    				{{$user->provider==''?$user->username:$user->provider}}
				    			</td>
				    			<td>
				    				{{$user->name}}
				    			</td>
				    			<td>
				    				{{$user->email}}
				    			</td>
				    			<td class="center">
				    				<a href="javascript:void(0)" class="charge" data-id="{{$user->id}}" data-toggle="modal" data-target="#balance">
				    					<i class="fa fa-money" data-toggle="tooltip" title="Nạp tiền"></i>
				    				</a>
				    				@if($user->username)
				    					<a href="javascript:void(0)" data-id="{{$user->id}}" class="change">
				    						<i class="fa fa-lock" data-toggle="tooltip" title="Đổi mật khẩu"></i>
				    					</a>
				    				@endif
				    				<a href="{{url('admin/users/'.$user->id)}}" class="delete"  data-toggle="tooltip" title="Xóa"><i class="fa fa-close"></i></a>
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

<div id="password" class="modal fade" role="dialog">
	<form class="modal-dialog" id="form-password">
		<input type="hidden" name="id">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">x</button>
				<h4 class="modal-title">Đổi mật khẩu</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<span class="error" id="password-error"></span>
					<input type="password" name="password" data-modalfocus placeholder="Mật khẩu" class="form-control" id="txt-password">
				</div>
				<div class="form-group">
					<input type="password" name="password_confirmed" placeholder="Nhập lại mật khẩu" class="form-control" id="password-confimed">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-change-password" data-url="{{url('admin/change-password')}}">Đổi mật khẩu</button>
			</div>
		</div>
	</form>
</div>

<div id="balance" class="modal fade" role="dialog">
	<form class="modal-dialog">
		<input type="hidden" name="id">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">x</button>
				<h4 class="modal-title">Nạp tiền</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<span class="error" id="balance-error"></span>
					<input type="text" name="balance" data-modalfocus class="form-control" placeholder="Số tiền">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-balance" data-url="{{url('admin/charge')}}">Nạp</button>
			</div>
		</div>
	</form>
</div>
{{csrf_field()}}
@endsection


@push('scripts')
	{{Html::script('public/js/admin.js')}}
@endpush
