@extends('layouts.app')

@section('title','Giỏ hàng')

@section('content')
    <div class="bg-white minimum text-center">
        {{Html::image('public/img/success.jpg')}}
        <h3 class="text-success">Đặt hàng thành công!</h3>
        <div class="text-center">
            <a href="{{url('/')}}"><i class="fa fa-double-arrow-left"></i> Về trang chủ</a>
        </div>
    </div>
@endsection
