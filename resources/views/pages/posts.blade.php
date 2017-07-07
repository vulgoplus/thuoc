@extends('layouts.post')

@section('title','Tin tức')

@section('content')
    <div class="special-title">
        <h2>Tin mới</h2>
    </div>
    <div style="margin-top: 15px"></div>
    <div class="post-first-item">
        <div class="post-first-image" style="background-image: url('{{asset('public/'.$newPosts[0]->image)}}');">
        </div>
        <div class="post-first-info">
            <a href="{{url('tin-tuc/'.$newPosts[1]->slug)}}"><h2>{{$newPosts[0]->title}}</h2></a>
            <p class="text-justify">
                {{$newPosts[0]->sumary}}
            </p>
            <a href="#" class="text-muted"><i class="fa fa-dropbox"></i> {{$newPosts[0]->name}}</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row has-margin-top flex-wrap">
        <div class="col-lg-4">
            <div class="post-item-4">
                <a href="{{url('tin-tuc/'.$newPosts[1]->slug)}}">{{Html::image('public/'.$newPosts[1]->image)}}</a>
                <a href="{{url('tin-tuc/'.$newPosts[1]->slug)}}"><h3>{{$newPosts[1]->title}}</h3></a>
                <a href="{{url('phan-loai/'.$newPosts[1]->alias)}}" class="text-muted"><i class="fa fa-dropbox"> {{$newPosts[1]->name}}</i></a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="post-item-4">
                <a href="{{url('tin-tuc/'.$newPosts[2]->slug)}}">{{Html::image('public/'.$newPosts[2]->image)}}</a>
                <a href="{{url('tin-tuc/'.$newPosts[2]->slug)}}"><h3>{{$newPosts[2]->title}}</h3></a>
                <a href="{{url('phan-loai/'.$newPosts[2]->alias)}}" class="text-muted"><i class="fa fa-dropbox"> {{$newPosts[2]->name}}</i></a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="post-item-4">
                <a href="{{url('tin-tuc/'.$newPosts[3]->slug)}}">{{Html::image('public/'.$newPosts[3]->image)}}</a>
                <a href="{{url('tin-tuc/'.$newPosts[3]->slug)}}"><h3>{{$newPosts[3]->title}}</h3></a>
                <a href="{{url('phan-loai/'.$newPosts[3]->alias)}}" class="text-muted"><i class="fa fa-dropbox"> {{$newPosts[3]->name}}</i></a>
            </div>
        </div>
    </div>

    <div class="row has-margin-top">
        <div class="col-lg-6">
            <a class="post-item-6">
                {{Html::image('public/'.$newPosts[4]->image)}}
                <div class="post-item-6-description">
                    <h2>{{$newPosts[4]->title}}</h2>
                    <p>
                        {{$newPosts[4]->sumary}}
                    </p>
                </div>
            </a>
        </div>
        <div class="col-lg-6">
            <a class="post-item-6">
                {{Html::image('public/'.$newPosts[5]->image)}}
                <div class="post-item-6-description">
                    <h2>{{$newPosts[5]->title}}</h2>
                    <p>
                        {{$newPosts[5]->sumary}}
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="special-title has-margin-top">
        <h2>{{$fashions->name}}</h2>
    </div>
    @foreach($fashions->posts as $post)
        <div class="post-item-12">
            {{Html::image('public/'.$post->image)}}
            <div class="post-item-12-description">
                <a href="{{url('tin-tuc/'.$post->slug)}}"><h2>{{$post->title}}</h2></a>
                <p class="text-justify">
                    {{$post->sumary}}
                </p>
                <a href="{{url('phan-loai/'.$fashions->slug)}}" class="text-muted"><i class="fa fa-dropbox"></i> {{$fashions->name}}</a>
            </div>
            <div class="clearfix"></div>
        </div>
    @endforeach

    <div class="special-title has-margin-top">
        <h2>{{$quickNews->name}}</h2>
    </div>
    @foreach($quickNews->posts as $post)
        <div class="post-item-12">
            {{Html::image('public/'.$post->image)}}
            <div class="post-item-12-description">
                <a href="{{url('tin-tuc/'.$post->slug)}}"><h2>{{$post->title}}</h2></a>
                <p class="text-justify">
                    {{$post->sumary}}
                </p>
                <a href="{{url('phan-loai/'.$quickNews->slug)}}" class="text-muted"><i class="fa fa-dropbox"></i> {{$quickNews->name}}</a>
            </div>
            <div class="clearfix"></div>
        </div>
    @endforeach
@endsection