@extends('admin.layouts.lumino')

@section('title', 'Đơn hàng')

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
		<h1 class="page-header">Đơn hàng</h1>
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
		<div class="text-right padding">
			{{Form::open(['url' => 'admin/orders/filter'])}}
				{{Form::text('from',isset($a)?$a:null,['class' => 'short-control datepicker', 'placeholder' => 'Từ ngày', 'data-date-format' => 'dd-mm-yyyy'])}}
				{{Form::text('to',isset($b)?$b:null,['class' => 'short-control datepicker', 'placeholder' => 'Đến ngày', 'data-date-format' => 'dd-mm-yyyy'])}}
				<button class="filter-button">Lọc</button>
			{{Form::close()}}
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách đơn hàng</div>
			<div class="panel-body table-responsive">
				<table class="table">
				    <thead>
				    <tr>
				    	<th><input type="checkbox" name="check-all" id="check-all"></th>
				        <th>Tới</th>
				    	<th>Phương thức</th>
				    	<th class="center">Thanh toán</th>
				    	<th class="center">Giao hàng</th>
				        <th class="center">Thao tác</th>
				    </tr>
				    </thead>
				    <tbody>
				    	@foreach($orders as $order)
				    		<tr>
				    			<td><input type="checkbox" class="select" name="id[]" value="{{$order->id}}"></td>
				    			<td>
				    				<strong>{{json_decode($order->customer_info, true)['name']}}</strong> <br>
				    				{{$order->phone}}
				    			</td>
				    			<td>
				    				@if($order->payment == 'cash')
				    					Tiền mặt
				    				@elseif($order->payment == 'paypal')
				    					Paypal
				    				@else
				    					Tại hệ thống
				    				@endif

				    			</td>
				    			<td class="center">
				    				@if($order->payment_status == 0)
				    					<span class="queue round-corner">Đang đợi</span>
				    				@else
				    					<span class="round-corner successful">Thành công</span>
				    				@endif
				    			</td>
				    			<td class="center">
				    				@if($order->status == 0)
				    					<span class="queue round-corner order-status" data-id="{{$order->id}}">Đang đợi</span>
				    				@else
				    					<span class="round-corner successful order-status" data-id="{{$order->id}}">Thành công</span>
				    				@endif
				    			</td>
				    			<td class="center">
				    				<a href="{{url('admin/orders/'.$order->id)}}" target="_blank" data-toggle="tooltip" title="Chi tiết"><i class="fa fa-bullseye"></i></a>
				    				<a href="{{url('admin/orders/'.$order->id)}}" class="delete" data-toggle="tooltip" title="Xóa"><i class="fa fa-remove"></i></a>
				    			</td>
				    		</tr>
				    	@endforeach
				    </tbody>
				</table>
				<div class="pagination-wrapper">
					@if($orders instanceof \Illuminate\Pagination\Paginator)
						{{$orders->render()}}
					@endif
				</div>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<button type="button" class="btn btn-danger" id="delete-items" data-url="{{url('admin/orders/delete')}}">Xóa mục chọn</button>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

@push('scripts')
	{{Html::script('public/lumino/js/bootstrap-datepicker.js')}}
	<script type="text/javascript">
		$('.datepicker').datepicker();
	</script>
@endpush
