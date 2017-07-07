<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('public/ficon.ico')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}
    {{Html::style('public/bower_components/awesome/css/font-awesome.min.css')}}
    {{Html::style('public/bower_components/animate/animate.min.css')}}
    {{Html::style('public/bower_components/owl/dist/assets/owl.carousel.min.css')}}
    {{Html::style('public/bower_components/owl/dist/assets/owl.theme.default.min.css')}}
    {{Html::style('public/css/jquery-ui.min.css')}}
    {{Html::style('public/css/jquery-ui.theme.min.css')}}
    @stack('styles')
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
        <form class="search-form" action="{{url('tim-kiem')}}" method="get">
            <div class="group">
                <input type="text" name="s" id="search-input" placeholder="Tìm kiếm">
                <button><i class="fa fa-search"></i></button>
            </div>
        </form>
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
                        <ul>
                            @foreach($taxonomies as $taxonomy)
                                <li><a href="{{url('phan-loai/'.$taxonomy->slug)}}">{{$taxonomy->name}}</a></li>
                            @endforeach
                        </ul>
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
            <div class="col-md-9 col-xs-12">
                @yield('content')
            </div> {{-- /.col-md-9 --}}
            <div class="col-md-3 col-xs-12">
                <div class="sidebar">
                    <div class="sidebar-item">
                        <h3>Bán chạy</h3>
                        @foreach($bestSeller as $product)
                            <div class="sidebar-product">
                                <a href="{{url('san-pham/'.$product->slug)}}">{{Html::image('public/'.$product->image,'',['style' => 'width: 50px'])}}</a>
                                <a href="{{url('san-pham/'.$product->slug)}}"><h5>{{$product->title}}</h5></a>
                                <span class="price">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                                <span class="old-price">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!}</span>
                            </div>
                        @endforeach
                    </div> {{-- /.sidebar-item --}}

                    <div class="sidebar-item has-margin-top" style="padding-top: 10px">
                        <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" height="200" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                    </div>
                </div>
            </div> {{-- /.col-md-3 --}}
        </div> {{-- /.row --}}
    </div> {{-- /.container --}}
</section>

@include('layouts.footer')

<input type="hidden" name="url" id="url" value="{{url('/')}}">
{{csrf_field()}}
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@stack('scripts')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1691415887818433";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
{{Html::script('public/bower_components/owl/dist/owl.carousel.min.js')}}
{{Html::script('public/js/jquery-ui.min.js')}}
{{Html::script('public/js/custom.js')}}
</body>
</html>