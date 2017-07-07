@extends('layouts.post')

@section('title', $taxonomy->name)

@section('content')
	<div class="special-title">
	    <h2>{{$taxonomy->name}}</h2>
	</div>
	<div class="row flex-wrap">
		@foreach($taxonomy->posts as $post)
			<div class="col-lg-4 short-margin-top">
			    <div class="post-item-4">
			        <a href="{{url('tin-tuc/'.$post->slug)}}">{{Html::image('public/'.$post->image)}}</a>
			        <a href="{{url('tin-tuc/'.$post->slug)}}"><h3>{{$post->title}}</h3></a>
			        <a href="{{url('phan-loai/'.$post->alias)}}" class="text-muted"><i class="fa fa-dropbox"> {{$taxonomy->name}}</i></a>
			    </div>
			</div>
		@endforeach
	</div>
@endsection