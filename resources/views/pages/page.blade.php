@extends('layouts.app')

@section('title',$page->title)

@section('content')
    <div class="bg-white padding minimum">
        {!!$page->content!!}
    </div>
@endsection
