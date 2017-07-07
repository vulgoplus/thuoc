@extends('admin.layouts.lumino')

@section('title','Trang chủ')

@section('content')
    <div class="row">
    	<div class="col-lg-12">
    		<h1 class="page-header">Bảng tin</h1>
    	</div>
    </div><!--/.row-->
    
    <div class="row">
    	<div class="col-xs-12 col-md-6 col-lg-3">
    		<div class="panel panel-blue panel-widget ">
    			<div class="row no-padding">
    				<div class="col-sm-3 col-lg-5 widget-left">
    					<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
    				</div>
    				<div class="col-sm-9 col-lg-7 widget-right">
    					<div class="large">{{$orders}}</div>
    					<div class="text-muted">Đơn hàng</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-xs-12 col-md-6 col-lg-3">
    		<div class="panel panel-orange panel-widget">
    			<div class="row no-padding">
    				<div class="col-sm-3 col-lg-5 widget-left">
    					<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
    				</div>
    				<div class="col-sm-9 col-lg-7 widget-right">
    					<div class="large">{{$comments}}</div>
    					<div class="text-muted">Bình luận</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-xs-12 col-md-6 col-lg-3">
    		<div class="panel panel-teal panel-widget">
    			<div class="row no-padding">
    				<div class="col-sm-3 col-lg-5 widget-left">
    					<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
    				</div>
    				<div class="col-sm-9 col-lg-7 widget-right">
    					<div class="large">{{$users}}</div>
    					<div class="text-muted">Người dùng</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-xs-12 col-md-6 col-lg-3">
    		<div class="panel panel-red panel-widget">
    			<div class="row no-padding">
    				<div class="col-sm-3 col-lg-5 widget-left">
    					<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
    				</div>
    				<div class="col-sm-9 col-lg-7 widget-right">
    					<div class="large">{{$products}}</div>
    					<div class="text-muted">Sản phẩm</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div><!--/.row-->
    
    <div class="row">
    	<div class="col-lg-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">Thống kê doanh thu (Đơn vị: Nghìn VND)</div>
    			<div class="panel-body">
    				<div class="canvas-wrapper">
    					<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
    				</div>
    			</div>
    		</div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p><strong style="color: #30a5ff">Thu nhập năm nay: {{number_format($venue)}} VNĐ</strong></p>
                    <p class="text-muted"><strong>Thu nhập năm trước: {{number_format($fVenue)}} VNĐ</strong></p>
                </div>
            </div>
    	</div>
    </div><!--/.row-->
@endsection

@push('scripts')
    {{Html::script('public/lumino/js/chart.min.js')}}
    <script type="text/javascript">
        var x = {{json_encode($previous)}};
        var y = {{json_encode($current)}}
    </script>
    {{Html::script('public/lumino/js/chart-data.js')}}
@endpush