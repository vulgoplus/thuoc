@extends('layouts.app')

@section('title',Auth::user()->name)

@section('content')
    <div class="bg-white padding minimum">
        <p class="has-margin-top">
            <strong>Họ tên: </strong>{{Auth::user()->name}}
        </p>
        <p class="has-margin-top">
            <strong>Tên đăng nhập: </strong>{{Auth::user()->username != null?Auth::user()->username:'Đăng nhập qua '.Auth::user()->provider}}
        </p>
        <p class="has-margin-top">
            <strong>Email: </strong>{{Auth::user()->email}}
        </p>
        <p class="has-margin-top">
            <strong>Điểm thưởng: </strong>{{number_format(Auth::user()->coupon)}}
        </p>
        <p class="has-margin-top">
            <strong>Số dư: </strong>{{number_format(Auth::user()->balance)}}
        </p>
        @if($orders->count() > 0)
            <p class="has-margin-top">
                <strong>Lịch sử giao dịch:  </strong>   
                <ul>
                    @foreach($orders as $order)
                        <li>Ngày: {{date('d/m/Y',strtotime($order->updated_at))}} - Mã đơn hàng: {{$order->id}} - Giá trị: {{number_format($order->subtotal)}}</li>
                    @endforeach
                </ul>
            </p>
        @endif
    </div>
@endsection
