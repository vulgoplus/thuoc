@extends('layouts.app')

@section('title', 'Viliti - Trang chủ')

@section('content')
<section class="featured">
    <div class="vertical-title">
        <h2>Nổi bật</h2>
    </div>
    <div class="owl-carousel border" id="featured">
        @foreach($featured as $product)
            <div class="product-item prd">
                <div class="img-wrapper">
                    <a href="{{url('san-pham/'.$product->slug)}}">{{Html::image('public/'.$product->image)}}</a>
                    <a href="{{url('san-pham/'.$product->slug)}}" class="btn-img left"><i class="fa fa-search-plus"></i></a>
                    <a href="#" class="btn-img right like {{in_array($product->id, $wishs)?'active':''}}" data-auth="{{Auth::check()?Auth::user()->id:'no'}}" data-product="{{$product->id}}"><i class="fa {{in_array($product->id, $wishs)?'fa-heart':'fa-heart-o'}}"></i></a>
                </div>
                <div class="product-description">
                    <h4>{{$product->title}}</h4>
                    <span class="new">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                    <span class="old">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                    <button class="add-to-cart" data-target="{{url('cart/add/'.$product->id)}}">Thêm vào giỏ hàng</button>
                </div>
            </div>
        @endforeach
    </div> {{-- /.owl-carousel --}}
</section> {{-- /.end-featured --}}

<section class="has-margin-top">
    <div class="owl-carousel slider">
        <div class="slider-item" style="background-image: url('{{asset('public/img/img-1.jpg')}}');"></div>
        <div class="slider-item" style="background-image: url('{{asset('public/img/img-4.jpg')}}');"></div>
    </div>
    <div class="row short-margin-top">
        @foreach($randoms as $product)
            <div class="col-md-4">
                <div class="product-item-1 prd">
                    <div class="img-wrapper">
                        <a href="{{url('san-pham/'.$product->slug)}}">{{Html::image('public/'.$product->image)}}</a>
                        <a href="{{url('san-pham/'.$product->slug)}}" class="btn-img left"><i class="fa fa-search-plus"></i></a>
                        <a href="#" class="btn-img right like {{in_array($product->id, $wishs)?'active':''}}" data-auth="{{Auth::check()?Auth::user()->id:'no'}}" data-product="{{$product->id}}"><i class="fa {{in_array($product->id, $wishs)?'fa-heart':'fa-heart-o'}}"></i></a>
                    </div>
                    <div class="product-description">
                        <h4>{{$product->title}}</h4>
                        <span class="new">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                        <span class="old">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                        <button class="add-to-cart" data-target="{{url('cart/add/'.$product->id)}}">Thêm vào giỏ hàng</button>
                    </div> {{-- /.product-description --}}
                </div> {{-- /.product-item --}}
            </div> {{-- /.col-lg-4 --}}
        @endforeach
    </div> {{-- /.row --}}
</section>

<section class="has-margin-top">
    <div class="special-title">
        <h2>Dành cho nữ</h2>
    </div>
    <div class="white-background owl-carousel normal-carousel border">
        @foreach($females as $product)
            <div class="product-item prd">
                <div class="img-wrapper">
                    <a href="{{url('san-pham/'.$product->slug)}}">{{Html::image('public/'.$product->image)}}</a>
                    <a href="{{url('san-pham/'.$product->slug)}}" class="btn-img left"><i class="fa fa-search-plus"></i></a>
                    <a href="#" class="btn-img right like {{in_array($product->id, $wishs)?'active':''}}" data-auth="{{Auth::check()?Auth::user()->id:'no'}}" data-product="{{$product->id}}"><i class="fa {{in_array($product->id, $wishs)?'fa-heart':'fa-heart-o'}}"></i></a>
                </div>
                <div class="product-description">
                    <h4>{{$product->title}}</h4>
                    <span class="new">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                    <span class="old">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                    <button class="add-to-cart" data-target="{{url('cart/add/'.$product->id)}}">Thêm vào giỏ hàng</button>
                </div>
            </div>
        @endforeach 
    </div> {{-- /.owl-carousel --}}
</section>

<section class="has-margin-top">
    <div class="special-title">
        <h2>Dành cho nam</h2>
    </div>
    <div class="white-background owl-carousel normal-carousel border">
        @foreach($males as $product)
            <div class="product-item prd">
                <div class="img-wrapper">
                    <a href="{{url('san-pham/'.$product->slug)}}">{{Html::image('public/'.$product->image)}}</a>
                    <a href="{{url('san-pham/'.$product->slug)}}" class="btn-img left"><i class="fa fa-search-plus"></i></a>
                    <a href="#" class="btn-img right like {{in_array($product->id, $wishs)?'active':''}}" data-auth="{{Auth::check()?Auth::user()->id:'no'}}" data-product="{{$product->id}}"><i class="fa {{in_array($product->id, $wishs)?'fa-heart':'fa-heart-o'}}"></i></a>
                </div>
                <div class="product-description">
                    <h4>{{$product->title}}</h4>
                    <span class="new">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                    <span class="old">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                    <button class="add-to-cart" data-target="{{url('cart/add/'.$product->id)}}">Thêm vào giỏ hàng</button>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="has-margin-top">
    <div class="special-title">
        <h2>Phụ kiện</h2>
    </div>
    <div class="white-background owl-carousel normal-carousel border">
        @foreach($acsrs as $product)
            <div class="product-item prd">
                <div class="img-wrapper">
                    <a href="{{url('san-pham/'.$product->slug)}}">{{Html::image('public/'.$product->image)}}</a>
                    <a href="{{url('san-pham/'.$product->slug)}}" class="btn-img left"><i class="fa fa-search-plus"></i></a>
                    <a href="#" class="btn-img right like {{in_array($product->id, $wishs)?'active':''}}" data-auth="{{Auth::check()?Auth::user()->id:'no'}}" data-product="{{$product->id}}"><i class="fa {{in_array($product->id, $wishs)?'fa-heart':'fa-heart-o'}}"></i></a>
                </div>
                <div class="product-description">
                    <h4>{{$product->title}}</h4>
                    <span class="new">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                    <span class="old">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                    <button class="add-to-cart" data-target="{{url('cart/add/'.$product->id)}}">Thêm vào giỏ hàng</button>
                </div>
            </div>
        @endforeach
    </div> {{-- /.owl-carousel --}}
</section>

<section class="has-margin-top">
    <div class="owl-carousel" id="branch">
        <div class="branch">{{Html::image('public/img/logos/1.gif')}}</div>
        <div class="branch">{{Html::image('public/img/logos/1.png')}}</div>
        <div class="branch">{{Html::image('public/img/logos/2.jpg')}}</div>
        <div class="branch">{{Html::image('public/img/logos/Idella.jpg')}}</div>
        <div class="branch">{{Html::image('public/img/logos/kk.png')}}</div>
        <div class="branch">{{Html::image('public/img/logos/lvi.png')}}</div>
        <div class="branch">{{Html::image('public/img/logos/x.gif')}}</div>
        <div class="branch">{{Html::image('public/img/logos/y.gif')}}</div>
    </div>
</section>
<input type="hidden" name="url" id="url" value="{{url('/')}}">
{{csrf_field()}}
@endsection

