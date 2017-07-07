@extends('admin.layouts.lumino')

@section('title', 'Bình luận')

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
		<h1 class="page-header">Bình luận</h1>
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
		<div class="panel panel-default">
			<div class="panel-heading">Bình luận</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Họ tên</th>
				        <th class="center">Chức năng</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($comments as $comment)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$comment->id}}"></td>
				    			<td>{{$comment->name}}</td>
				    			<td class="center">
				    				<a href="javascript:void(0)" class="detail"><i class="fa fa-external-link"></i></a>
				    				<a href="{{url('admin/comments/'.$comment->id)}}" class="delete"><i class="fa fa-close"></i></a>
				    				<p class="content hidden">{{$comment->content}}</p>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$comments->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/comments/destroy')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	

<div id="feedback" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Nội dung</h4>
	    </div>
	    <div class="modal-body">
	        <p id="feedback-content">
	        	
	        </p>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	    </div>
	</div>
</div>
</div>
{{csrf_field()}}
@endsection

