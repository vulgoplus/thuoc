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

<section class="has-margin-top">
    <div class="container">
        <div class="row flex-wrap">
            <div class="col-md-9">
                
                @yield('content')
                
            </div> {{-- /.col-md-9 --}}
            <div class="col-md-3">
                
                <div class="sidebar">
                    <div class="sidebar-item">
                        <h3>Tin nổi bật</h3>
                        @foreach($featured as $post)
                            <div class="sidebar-product">
                                <a href="#">{{Html::image('public/'.$post->image,$post->title,['width' => 50, 'height' => 50])}}</a>
                                <a href="#"><h5>{{$post->title}}</h5></a>
                                <div class="clearfix"></div>
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
{{Html::script('public/js/custom.js')}}
</body>
</html>