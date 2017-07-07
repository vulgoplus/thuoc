@extends('layouts.post')

@section('title',$post->title)

@section('content')
    <div class="single-title bg-white">
        <h1>{{$post->title}}</h1>
        <small class="text-muted">Đăng ngày {{date('d/m/Y',strtotime($post->created_at))}}</small>
    </div>
    <div class="bg-white padding text-justify">
        {!!$post->content!!}
    </div>
    <div class="has-margin-top bg-white">
        <div class="fb-comments" data-href="{{Request::fullUrl()}}" data-numposts="5" width="100%"></div>
    </div>

    <div class="special-title has-margin-top">
        <h2>Liên quan</h2>
    </div>
    <div class="row flex-wrap">
        @foreach($relates as $post)
            <div class="col-lg-4 has-margin-top">
                <div class="post-item-4">
                    <a href="{{url('tin-tuc/'.$post->slug)}}">{{Html::image('public/'.$post->image)}}</a>
                    <a href="{{url('tin-tuc/'.$post->slug)}}"><h3>{{$post->title}}</h3></a>
                    <a href="{{url('phan-loai/'.$post->alias)}}" class="text-muted"><i class="fa fa-dropbox"> {{$post->name}}</i></a>
                </div>
            </div>
        @endforeach 
    </div>
@endsection