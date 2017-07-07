@extends('admin.layouts.lumino')

@section('title', 'Bảng tin')

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
		<h1 class="page-header">Sản phẩm</h1>
		<a href="{{url('admin/posts/create')}}" class="btn btn-primary btn-header"><i class="fa fa-plus"></i> &nbsp;&nbsp;Bài viết mới</a>
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
			<div class="panel-heading">Danh sách tin tức</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tiêu đề</th>
				        <th class="center">Nổi bật</th>
				        <th class="center">Chức năng</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($posts as $post)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$post->id}}"></td>
				    			<td>
				    				<a href="{{url('admin/posts/'.$post->id.'/edit')}}" class="product-link">{{$post->title}}</a>
				    			</td>
				    			<td class="center">
				    				<label class="{{$post->featured==1?'has-featured':'no-featured'}} featured" data-target="{{url('admin/posts/featured/'.$post->id)}}"></label>
				    			</td>
				    			<td class="center">
				    				<a href="{{url('admin/posts/'.$post->id.'/edit')}}" data-toggle="tooltip" title="Sửa"><i class="fa fa-pencil-square-o"></i></a>
				    				<a href="{{url('admin/posts/'.$post->id)}}" class="delete" data-toggle="tooltip" title="Xóa"><i class="fa fa-close"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$posts->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/posts/destroy')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

