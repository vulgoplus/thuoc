@extends('layouts.admin')

@section('title', 'Chi tiết')

@section('body')
<div class="row">
	<ol class="breadcrumb">
		<li><a href="{{url('admin')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		@foreach($breadcrumps as $breadcrump)
			<li class="active">{!!isset($breadcrump['href'])?'<a href="'.$breadcrump['href'].'">'.$breadcrump['name'].'</a>':$breadcrump['name']!!}</li>
		@endforeach
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12 adm-header">
		<h1 class="page-header">Chi tiết trang</h1>
		<a href="{{url('admin')}}" class="btn btn-primary btn-header"><i class="fa fa-bars"></i> &nbsp;&nbsp;Danh sách bản tin</a>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Chi tiết Trang</div>
			<div class="panel-body">
				<div>
					<h2>{{$page->title}}</h2>
				</div>
				{!!$page->content!!}
				<a href="#" onclick="window.history.back(-1)"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Trở về</button></a>
			</div> <!--/ .panel-body -->
		</div> <!--/.panel-->
	</div>
</div><!--/.row-->	
{{csrf_field()}}
@endsection

