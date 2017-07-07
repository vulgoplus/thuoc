@extends('admin.layouts.lumino')

@section('title', 'Chi tiết đơn hàng')

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
		<div class="panel panel-default">
			<div class="panel-heading">Chi tiết đơn hàng số #{{$order->id}}</div>
			<div class="panel-body table-responsive">
				<p>Họ tên: <b>{{json_decode($order->customer_info,true)['name']}}</b></p>
				<p>Email: <b>{{json_decode($order->customer_info,true)['email']}}</b></p>
				<p>Địa chỉ nhận hàng: <b>{{$order->address}}</b></p>
				<p>Điện thoại: <b>{{$order->phone}}</b></p>
				<p>Tiền thanh toán: <b>{{number_format($order->subtotal)}} VNĐ</b></p>
				<p>Phương thức thanh toán: 
					<b>
						@if($order->payment == 'cash')
							Tiền mặt
						@elseif($order->payment == 'paypal')
							Paypal
						@else
							Tại hệ thống
						@endif
					</b>
				</p>
				<p>Thanh toán: <b>{{$order->payment_status == 0? 'Chưa thanh toán':'Đã thanh toán'}}</b></p>
				<p>Giao hàng: <b>{{$order->status == 0?'Chưa giao hàng':'Đã giao hàng'}}</b></p>
				<h3>Chi tiết đơn hàng</h3>
				<table class="table">
					<tr>
						<th>Sản phẩm</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Thành tiền</th>
					</tr>
					@foreach($order->orderItems as $item)
						<tr>
							<td>
								{{$item->product->title}}
							</td>
							<td>{{$item->product->sale == 0 ? number_format($item->product->price) : number_format($item->product->sale)}}</td>
							<td>{{$item->qty}}</td>
							<td>{{number_format($item->total)}}</td>
						</tr>
					@endforeach
				</table>
			</div> <!--/ .panel-body -->
			<div class="panel-footer">
				<a href="{{url('admin/orders')}}"><button type="button" class="btn btn-danger"><i class="fa fa-angle-double-left"></i> Trở về</button></a>
			</div>
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

