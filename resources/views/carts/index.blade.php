@extends('layouts.app')

@section('title','Giỏ hàng')

@section('content')
    <div class="bg-white padding minimum">
        <div class="deep-section">
            @if(Cart::content()->count() > 0)
                <h2>Tổng cộng {{Cart::content()->count()}} sản phẩm</h2>
                {{Form::open(['url' => 'cart/update', 'class' => 'cart-form table-responsive'])}}
                    <table class="cart-table">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        @foreach(Cart::content() as $key => $item)
                            <tr>
                                <td>
                                    {{Html::image('public/'.$item->options->image)}}
                                    <h4>{{$item->name}}</h4>
                                </td>
                                <td>{{number_format($item->price)}} VNĐ</td>
                                <td class="center">
                                    <div class="number">
                                        <input type="hidden" name="{{$key}}" min="0" max="100" value="{{$item->qty}}">
                                        <button type="button" class="decrement">-</button>
                                        <div class="qty">{{$item->qty}}</div>
                                        <button type="button" class="increment">+</button>
                                    </div>
                                </td>
                                <td>{{number_format($item->total)}} VNĐ</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="has-margin-top"></div>
                    <button class="btn-own">Cập nhật giỏ hàng</button>
                    <a href="{{url('cart/destroy')}}"><button type="button" class="btn-destroy">Hủy giỏ hàng</button></a>
                {{Form::close()}}
                <h2>Tổng tiền: {{Cart::subtotal(0,'',',')}} VNĐ</h2>
                <div class="pull-right">
                    <a href="{{url('/thanh-toan')}}">
                        <button type="button" class="btn-own">THANH TOÁN <i class="fa fa-long-arrow-right"></i></button>
                    </a>
                </div>
                <br clear="all">
                <a href="{{url('/')}}"><i class="fa fa-angle-double-left"></i> Mua tiếp</a>
            @else
                <div style="text-align: center;">
                    
                </div>
            @endif
        </div> <!-- /.section -->
    </div> <!-- /.bg-white -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.decrement').click(function(){
                var num = Number($(this).siblings('.qty').text());
                num--;
                if(num < 0){
                    $(this).siblings('.qty').text(0);
                    $(this).siblings('input').val(0);
                }else{
                    $(this).siblings('.qty').text(num);
                    $(this).siblings('input').val(num);
                }
            });
            $('.increment').click(function(){
                var num = Number($(this).siblings('.qty').text());
                num++;
                if(num > 99){
                    $(this).siblings('.qty').text(99);
                    $(this).siblings('input').val(99);
                }else{
                    $(this).siblings('.qty').text(num);
                    $(this).siblings('input').val(num);
                }
            });
        });
    </script>
@endpush

@if(session('success'))
    <div class="notification notification-success animated slideInLeft">
        {{session('success')}}
    </div>
    <script type="text/javascript">
        setTimeout(function(){
            $('.notification').removeClass('slideInLeft').addClass('slideOutLeft');
        }, 3000);
    </script>
@endif