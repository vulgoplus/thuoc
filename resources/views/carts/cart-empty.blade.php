@extends('layouts.app')

@section('title','Giỏ hàng')

@section('content')
    <div class="bg-white minimum text-center">
        {{Html::image('public/img/cart-empty.jpg')}}
        <h3>Xin lỗi, Hiện tại không có sản phẩm nào trong giỏ hàng của bạn!</h3>
        <h3>Vui lòng mua hàng rồi quay lại sau!</h3>
    </div>
@endsection

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