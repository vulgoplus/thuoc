<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán</title>
    <link rel="shortcut icon" href="{{asset('public/ficon.ico')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}
    {{Html::style('public/bower_components/awesome/css/font-awesome.min.css')}}
    {{Html::style('public/bower_components/animate/animate.min.css')}}
    {{Html::style('public/bower_components/owl/dist/assets/owl.carousel.min.css')}}
    {{Html::style('public/bower_components/owl/dist/assets/owl.theme.default.min.css')}}
    {{Html::style('public/css/style.css')}}
    {{Html::script('public/bower_components/jquery/dist/jquery.min.js')}}
</head>
<body>
<header class="header-info">
    @include('layouts.header')
</header> {{-- /.header-info --}}
<header class="header">
    <div class="container">
        <a href="{{url('/')}}" title="Trang chủ">{{Html::image('public/img/logo.png','Viliti shop',['class' => 'logo'])}}</a>
        <div class="right">
            <div class="menu">
                <i class="fa fa-bars fa-2x"></i>
                <ul class="sub-menu disable animated">
                    <li class="col-md-3">
                        <h3>Thời trang nam</h3>
                        <ul>
                            @foreach($categories as $category)
                                @if($category->parent == 1)
                                    <li><a href="{{url('danh-muc/'.$category->slug)}}">{{$category->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="col-md-3">
                        <h3>Thời trang nữ</h3>
                        <ul>
                            @foreach($categories as $category)
                                @if($category->parent == 2)
                                    <li><a href="{{url('danh-muc/'.$category->slug)}}">{{$category->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="col-md-3">
                        <h3>Phụ kiện</h3>
                        <ul>
                            @foreach($categories as $category)
                                @if($category->parent == 3)
                                    <li><a href="{{url('danh-muc/'.$category->slug)}}">{{$category->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="col-md-3">
                        <h3>Tin tức</h3>
                    </li>
                </ul>
            </div>
            <div class="cart-container">
                <a href="{{url('gio-hang')}}" class="cart">
                    {{Html::image('public/img/cart.png')}}
                    <span id="cart-mumber">{{Cart::content()->count()}}</span>
                </a>
            </div> {{-- /.cart-container --}}
        </div> {{-- /.right --}}
    </div> {{-- /.container --}}
</header> {{-- /.header --}}
<div class="banner">
    <div class="owl-carousel" id="banner">
        <div class="banner-item" style="background-image: url('{{asset('public/img/slide1.jpg')}}')"></div>
        <div class="banner-item" style="background-image: url('{{asset('public/img/slide3.jpg')}}')"></div>
        <div class="banner-item" style="background-image: url('{{asset('public/img/slide4.jpg')}}')"></div>
    </div>
</div> {{-- /.banner --}}
<div class="promotion">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <i class="fa fa-truck fa-3x"></i>
                <h3>Vận chuyển miễn phí</h3>
                <p>Với các đơn hàng trên 500.000 VNĐ</p>
            </div>
            <div class="col-md-3">
                <i class="fa fa-phone fa-3x"></i>
                <h3>Hỗ trợ 24/7</h3>
                <p>Giải đáp mọi thắc mắc</p>
            </div>
            <div class="col-md-3">
                <i class="fa fa-comments fa-3x"></i>
                <h3>Hợp tác kinh doanh</h3>
                <p>Bán sỉ, bán lẻ</p>
            </div>
            <div class="col-md-3">
                <i class="fa fa-money fa-3x"></i>
                <h3>Cam kết giá tốt nhất</h3>
                <p>Đảm bảo chất lượng 100%</p>
            </div>
            <br clear="all">
        </div> {{-- /.row --}}
    </div> {{-- /.container --}}
</div> {{-- /.promotion --}}

<section class="has-margin-top">
    <div class="container">
        <div class="row flex-wrap">
            <div class="col-md-7">
               <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Thông tin đơn hàng</h4>
                    </div>
                    <div class="panel-body">
                        <h4 class="text-success">Bạn nhận được {{Cart::count() * 50}} điểm thưởng với đơn hàng này!</h4>

                        <table class="cart-table">
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th class="center">Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            @foreach(Cart::content() as $key => $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{number_format($item->price)}} đ</td>
                                    <td class="center">
                                        {{$item->qty}}
                                    </td>
                                    <td>{{number_format($item->total)}} đ</td>
                                </tr>
                            @endforeach
                        </table>
                        <h3>Tổng cộng: {{Cart::count()}} món hàng/{{Cart::content()->count()}} sản phẩm</h3>
                        <h3>Tổng tiền: {{Cart::subtotal(0,'',',')}} VNĐ</h3>
                        <button onclick="window.history.back(-1)" class="btn-destroy"><i class="fa fa-angle-left"></i> Quay lại</button>
                    </div> {{-- /.panel-body --}}
               </div> {{-- /.panel --}}

               <div class="panel panel-default">
                   <div class="panel-heading">
                       <h4>Hình thức thanh toán</h4>
                   </div>
                   <div class="panel-body">
                       @if(Auth::check())
                            <p>
                                <input type="checkbox" name="coupon-toggle" id="coupon-toggle" data-condition="{{Auth::user()->coupon - 1000 < 0?'0':'1'}}"> Sử dụng 1.000 điểm thưởng để giảm 10% tổng giá trị đơn hàng (Hiện có: <span class="text-danger">{{number_format(Auth::user()->coupon)}}</span>)
                            </p>
                       @endif
                       <h3>Hình thức</h3>
                       <p>
                           <ul type="none">
                               <li>
                                   <input type="radio" name="payment" value="cash" checked=""> Thanh toán khi nhận hàng
                               </li>
                               @if(Auth::check())
                                    <li>
                                        <input type="radio" name="payment" id="vlt" value="viliti" data-condition="{{Auth::user()->balance - Cart::subtotal(0,'','') < 0?'0':'1'}}"> Thanh toán bằng tài khoản Viliti (Hiện có: <span class="text-danger">{{number_format(Auth::user()->balance)}} đ</span>)
                                    </li>
                               @endif
                               <li>
                                   <input type="radio" name="payment" value="paypal"> Thanh toán qua Paypal
                               </li>
                           </ul>
                       </p>
                   </div>
               </div>
            </div> {{-- /.col-md-9 --}}
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Thông tin của bạn</h4>
                    </div>
                    <div class="panel-body">
                        {{Form::open(['url' => 'cart/store', 'id' => 'form-payment'])}}
                            <input type="hidden" name="_coupon" value="0">
                            <input type="hidden" name="_payment" value="cash">
                            <div class="form-group">
                                <label>Họ tên: </label>
                                {{Form::text('name', Auth::check()?Auth::user()->name:'', ['class' => 'control', 'placeholder' => 'Họ tên'])}}
                                <span class="error">{{ $errors->has('name')?$errors->first('name'):'' }}</span>
                            </div>

                            <div class="form-group">
                                <label>Email: </label>
                                {{Form::email('email', Auth::check()?Auth::user()->email:'', ['class' => 'control', 'placeholder' => 'Email'])}}
                                <span class="error">{{ $errors->has('email')?$errors->first('email'):'' }}</span>
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ: </label>
                                {{Form::text('address', null, ['class' => 'control', 'placeholder' => 'Địa chỉ'])}}
                                <span class="error">{{ $errors->has('address')?$errors->first('address'):'' }}</span>
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại: </label>
                                {{Form::text('phone', Auth::check()?Auth::user()->phone:'', ['class' => 'control', 'placeholder' => 'Số điện thoại'])}}
                                <span class="error">{{ $errors->has('phone')?$errors->first('phone'):'' }}</span>
                            </div>

                            <div class="form-group">
                                <label>Ghi chú (tùy chọn): </label>
                                {{Form::textarea('note', null, ['class' => 'control', 'rows' => 4, 'placeholder' => 'Ghi chú'])}}
                            </div>
                            <button class="btn-own">Mua hàng</button>
                        {{Form::close()}}
                    </div> {{-- /.panel-body --}}
                </div> {{-- /.panel --}}
            </div> {{-- /.col-md-3 --}}
        </div> {{-- /.row --}}
    </div> {{-- /.container --}}
</section>

@include('layouts.footer')

<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1691415887818433";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
{{Html::script('public/bower_components/owl/dist/owl.carousel.min.js')}}
{{Html::script('public/js/pay.js')}}
{{Html::script('public/js/custom.js')}}
</body>
</html>