@extends('layouts.app')

@section('title',$product->title)

@section('content')
    <div class="bg-white padding">
        <div class="row">
            <div class="col-md-6 product-image">
                {{Html::image('public/'.$product->image,$product->title,['id' => 'image', 'data-zoom-image' => asset('public/'.$product->image)])}}
            </div>
            <div class="col-md-6 product-info">
                <h1>{{$product->title}}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="rating">
                            <select id="rating" name="rating" data-current-rating="{{$product->rate==null?0:$product->rate}}" autocomplete="off">
                                <option value=""></option>
                                <option value="1"></option>
                                <option value="2"></option>
                                <option value="3"></option>
                                <option value="4"></option>
                                <option value="5"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <strong id="product-rate">{{$product->rate==null?'Chưa có đánh giá nào!':$product->rate.'/5'}}</strong>
                    </div>
                </div>

                {!!$product->short_description!!}

                <div>
                    <h3 class="text-danger">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></h3>
                    <span class="old">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                </div>

                <form method="POST" action="{{url('them-vao-gio')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="number-primary">
                        <input type="hidden" name="qty" min="1" max="100" value="1">
                        <button type="button" class="decrement">-</button>
                        <div class="qty">1</div>
                        <button type="button" class="increment">+</button>
                    </div>
                    <div style="margin-bottom: 15px"></div>
                    <a><button class="btn-own">Thêm vào giỏ hàng</button></a>
                </form>
            </div>
        </div>
    </div> <!-- /.bg-white -->

    <div class="has-margin-top bg-white">
        <div class="v-tabs">
            <div class="v-tab active" data-target="#tab-1">
                Chi tiết sản phẩm
            </div>
            <div class="v-tab" data-target="#tab-2">
                Ý kiến & Đánh giá
            </div>
        </div>
        <div class="t-tab padding" id="tab-1">
            {!!$product->description!!}
        </div>
        <div class="t-tab padding hidden" id="tab-2">
            @if(Auth::check())
                <div class="rating">
                    Đánh giá của bạn
                    <select id="rate" name="rating" data-current-rating="{{$ratePoint}}" autocomplete="off">
                        <option value=""></option>
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                        <option value="4"></option>
                        <option value="5"></option>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            @endif
            <div id="comments">
                @if($comments->count() > 0)
                    @foreach($comments as $comment)
                        <div class="comment-item">
                            <strong>{{$comment->name}}</strong>
                            <small>{{date('d/m/Y',strtotime($comment->created_at))}}</small>
                            <p>
                                {{$comment->content}}
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">
                        Chưa có bình luận nào!
                    </p>
                @endif
            </div>
            <div class="has-margin-top">
                <div class="row">
                    <div class="col-md-6">
                        {{Form::open(['url' => 'comment','id' => 'frmComment'])}}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            @if(Auth::check())
                                <input type="hidden" name="name" value="{{Auth::user()->name}}">
                            @else
                                <div class="form-group">
                                    {{Form::text('name',null,['class' => 'control','placeholder' => 'Họ tên'])}}
                                    <span class="error" id="name-error"></span>
                                </div>
                            @endif
                            <div class="form-group">
                                {{Form::textarea('content',null,['class' => 'control', 'rows' => 2, 'placeholder' => 'Nội dung'])}}
                                <span class="error" id="content-error"></span>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn-small">Đăng</button>
                            </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{Html::style('public/bower_components/bar-rating/dist/themes/fontawesome-stars-o.css')}}
@endpush

@push('scripts')
    {{Html::script('public/bower_components/bar-rating/dist/jquery.barrating.min.js')}}
    {{Html::script('public/bower_components/elevatezoom/jquery.elevatezoom.js')}}
    {{Html::script('public/js/product.js')}}
@endpush
