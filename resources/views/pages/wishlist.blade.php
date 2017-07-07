@extends('layouts.app')

@section('title','Danh sách yêu thích')

@section('content')
    <div class="minimum">
        @if($wishList->count() > 0)
            @foreach($wishList as $product)
                <div class="wish-list-item">
                    {{Html::image('public/'.$product->image,null,['height' => 120, 'width' => 120])}}
                    <h3><a href="{{url('san-pham/'.$product->slug)}}">{{$product->title}}</a></h3>
                    <div class="wl-price">
                        <span class="price">{{$product->sale==0?number_format($product->price):number_format($product->sale)}} <sup>đ</sup></span>
                        <span class="old-price">{!!$product->sale==0?'':number_format($product->price).' <sup>đ</sup>'!!} </span>
                    </div>
                    <a href="{{url('add-single-item/'.$product->id)}}"><button class="btn btn-success">Mua ngay</button></a>
                    <span class="close" data-dismiss="wish-list-item" data-id="{{$product->id}}"><i class="fa fa-close"></i></span>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        @else
            <div class="bg-white padding">
                <h3 class="text-muted">Không có sản phẩm nào trong danh sách yêu thích!</h3>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-dismiss="wish-list-item"]').click(function(){
                var x = $(this);
                var id = $(this).data('id');
                var url = "{{url('wishlist/delete/')}}";
                if(confirm('Bạn có chắc muốn xóa?')){
                    $.ajax({
                        url: url+'/'+id,
                        method: 'GET',
                        success: function(data){
                            x.parent().remove();
                        },
                        error: function(){
                            alert('Có lỗi xảy ra!');
                        }
                    });
                }
            });
        });
    </script>
@endpush