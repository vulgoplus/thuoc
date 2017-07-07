@extends('layouts.app')

@section('title',$category->name)

@section('content')
    <div class="special-title">
        <h2>{{$category->name}}</h2>
    </div>
    <div class="row flex-wrap minimum">
        @if($category->products->count() > 0)
            @foreach($category->products as $product)
                <div class="col-lg-4 short-margin-top">
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
        @else
            <div class="col-xs-12">
                <h3 class="text-center text-muted bg-white" style="width: 100%; padding: 15px">Chưa có sản phẩm nào!</h3>
            </div>
        @endif
    </div>
@endsection

