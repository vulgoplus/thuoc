@extends('layouts.app')

@section('title', 'Thanh toán với Paypal')

@section('content')
	<div class="bg-white padding minimum">
		<div id="pay-success">
			<table class="cart-table">
			    <tr>
			        <th>Tên sản phẩm</th>
			        <th>Giá</th>
			        <th class="center">Số lượng</th>
			        <th>Thành tiền</th>
			    </tr>
			    @foreach($order->orderItems as $item)
			        <tr>
			            <td>{{$item->product->title}}</td>
			            <td>{{number_format($item->product->price)}} đ</td>
			            <td class="center">
			                {{$item->qty}}
			            </td>
			            <td>{{number_format($item->total)}} đ</td>
			        </tr>
			    @endforeach
			</table>
			<h3>Tổng tiền: {{number_format($order->subtotal)}} VNĐ</h3>
			<hr>
			<h3>Thanh toán qua paypal</h3>
			<div id="paypal-button-container"></div>
		</div>

		<script>
			var subtotal = '{{number_format($order->subtotal/23000, 2)}}';
			var orderID  = {{$order->id}};
		    // Render the PayPal button

		    paypal.Button.render({

		        // Set your environment

		        env: 'sandbox', // sandbox | production

		        // PayPal Client IDs - replace with your own
		        // Create a PayPal app: https://developer.paypal.com/developer/applications/create\
		        client: {
		            sandbox: 'AeGkeyP51IlBh7Lg_NJYi_iFI4uKtqW4UTK7xE53P_IXkuzngoyI2_wY75gGi5loCPORDZbzFdeQo4MO',
		        },
		        // Set to 'Pay Now'
		        commit: true,
		        // Wait for the PayPal button to be clicked
		        payment: function() {
		            // Make a client-side call to the REST api to create the payment
		            return paypal.rest.payment.create(this.props.env, this.props.client, {
		                transactions: [
		                    {
		                        amount: { total: subtotal, currency: 'USD' }
		                    }
		                ]
		            });
		        },
		        // Wait for the payment to be authorized by the customer
		        onAuthorize: function(data, actions) {
		            // Execute the payment
		            return actions.payment.execute().then(function() {
		                document.querySelector('#pay-success').innerHTML = '<h3 style="color: green">Thanh toán thành công!</h3>';
		                $.ajax({
		                    url: '{{url('change-payment-status')}}',
		                    method: 'POST',
		                    data: {
		                        order_id: orderID,
		                        status: 1,
		                        _token: '{{csrf_token()}}'
		                    },
		                    success: function(data){
		                        
		                    },
		                    error: function(){
		                        alert('Có lỗi xảy ra!');
		                    }
		                });
		            });
		        }
		    }, '#paypal-button-container');

		</script>
	</div>
@endsection

@push('styles')
	{{Html::script('https://www.paypalobjects.com/api/checkout.js')}}
@endpush