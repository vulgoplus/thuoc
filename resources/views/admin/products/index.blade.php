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
		<a href="{{url('admin/products/create')}}" class="btn btn-primary btn-header"><i class="fa fa-plus"></i> &nbsp;&nbsp;Thêm sản phẩm</a>
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
		<div class="text-right padding">
			{{Form::open(['url' => 'admin/products/filter'])}}
				{{Form::text('title',isset($b)?$b:null,['class' => 'short-control', 'placeholder' => 'Tên sản phẩm'])}}
				<select name="category_id" class="short-control">
					<option value="0">Tất cả</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->name}} ({{$category->products->count()}})</option>
					@endforeach
				</select>
				<button class="filter-button">Lọc</button>
			{{Form::close()}}
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách sản phẩm</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tên sản phẩm</th>
				        <th>Giá</th>
				        <th class="center">Nổi bật</th>
				        <th class="center">Chức năng</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($products as $product)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$product->id}}"></td>
				    			<td>
				    				<div class="product-img">{{Html::image('public/'.$product->image)}}</div>
				    				<a href="{{url('admin/products/'.$product->id.'/edit')}}" class="product-link">{{$product->title}}</a>
				    			</td>
				    			<td>
				    				<span class="label label-danger">{{$product->sale==0?number_format($product->price):number_format($product->sale)}}</span>
				    				<div class="old-price">
				    					{{$product->sale==0?'':number_format($product->price)}}
				    				</div>
				    			</td>
				    			<td class="center">
				    				<label class="{{$product->featured==1?'has-featured':'no-featured'}} featured" data-target="{{url('admin/products/featured/'.$product->id)}}"></label>
				    			</td>
				    			<td class="center">
				    				<a href="{{url('admin/products/'.$product->id.'/edit')}}" data-toggle="tooltip" title="Sửa"><i class="fa fa-pencil-square-o"></i></a>
				    				<a href="{{url('admin/products/'.$product->id)}}" class="delete" data-toggle="tooltip" title="Xóa"><i class="fa fa-close"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					{{$products->render()}}
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/products/delete')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

