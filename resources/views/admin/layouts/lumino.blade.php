<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<link rel="shortcut icon" href="{{asset('public/aicon.ico')}}" type="image/x-icon">
{{Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}
{{Html::style('public/bower_components/awesome/css/font-awesome.min.css')}}
{{Html::style('public/lumino/css/datepicker3.css')}}
{{Html::style('public/lumino/css/styles.css')}}

<!--Icons-->
{{Html::script('public/lumino/js/glyphs.js')}}

<!--[if lt IE 9]>
{{Html::script('public/lumino/js/html5shiv.js')}}
{{Html::script('public/lumino/js/respond.min.js')}}
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Vulgo</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<svg class="glyph stroked male-user">
								<use xlink:href="#stroked-male-user"></use>
							</svg> 
							{{Auth::user()->name}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							{{-- <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Thông tin</a></li> --}}
							<li><a href="#" data-toggle="modal" data-target="#admin-password"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Đổi mật khẩu</a></li>
							<li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="padding-top: 1px">
		<h3 class="text-muted" style="padding-left: 15px;padding-bottom: 15px; border-bottom: 1px solid #eee">MENU</h3>
		<ul class="nav menu">
			<li class="{{Request::segment(2)==''?'active':''}}"><a href="{{url('admin/')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Bảng tin</a></li>
			<li class="{{Request::segment(2)=='products'||Request::segment(2)=='categories'?'active':''}} parent">
				<a href="{{url('admin/products')}}">
					<span data-toggle="collapse" href="#products"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg></span> Sản phẩm
				</a>
				<ul id="products" class="{{Request::segment(2)=='products'||Request::segment(2)=='categories'?'':'collapse'}} children">
					<li>
						<a href="{{url('admin/products')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Xem tất cả</a>
					</li>
					<li>
						<a href="{{url('admin/products/create')}}"> <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Thêm sản phẩm</a>
					</li>
					<li>
						<a href="{{url('admin/categories')}}"> <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Danh mục</a>
					</li>
				</ul>
			</li>
			<li class="{{Request::segment(2)=='pages'?'active':''}} parent">
				<a href="{{url('admin/pages')}}">
					<span data-toggle="collapse" href="#pages"><svg class="glyph stroked blank document"><use xlink:href="#stroked-blank-document"/></svg></span> Trang
				</a>
				<ul id="pages" class="{{Request::segment(2)=='pages'?'':'collapse'}} children">
					<li>
						<a href="{{url('admin/pages')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Xem tất cả</a>
					</li>
					<li>
						<a href="{{url('admin/pages/create')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Thêm trang</a>
					</li>
				</ul>
			</li>
			<li class="{{Request::segment(2)=='posts'||Request::segment(2)=='taxonomies'?'active':''}} parent">
				<a href="{{url('admin/posts')}}">
					<span data-toggle="collapse" href="#posts"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg></span> Tin tức
				</a>
				<ul id="posts" class="{{Request::segment(2)=='posts'||Request::segment(2)=='taxonomies'?'':'collapse'}} children">
					<li>
						<a href="{{url('admin/posts')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Xem tất cả</a>
					</li>
					<li>
						<a href="{{url('admin/posts/create')}}"> <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Thêm tin tức</a>
					</li>
					<li>
						<a href="{{url('admin/taxonomies')}}"> <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Danh mục</a>
					</li>
				</ul>
			</li>
			<li class="{{Request::segment(2)=='sliders'?'active':''}}"><a href="{{url('admin/sliders')}}"><svg class="glyph stroked film"><use xlink:href="#stroked-film"/></svg> Slider</a></li>
			<li class="{{Request::segment(2)=='orders'?'active':''}}"><a href="{{url('admin/orders')}}"><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"/></svg> Đơn hàng ({{Common::newOrder()}})</a></li>
			<li class="{{Request::segment(2)=='comments'?'active':''}}"><a href="{{url('admin/comments')}}"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Bình luận</a></li>
			<li class="{{Request::segment(2)=='feedback'?'active':''}}"><a href="{{url('admin/feedback')}}"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Phản hồi</a></li>
			<li class="{{Request::segment(2)=='admins'?'active':''}}"><a href="{{url('admin/admins')}}"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Quản trị viên</a></li>
			<li class="{{Request::segment(2)=='users'?'active':''}}"><a href="{{url('admin/users')}}"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Thành viên</a></li>

		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		@yield('content')

	</div>	<!--/.main-->

	<!-- Admin password modal -->
	<div class="modal fade" role="dialog" id="admin-password">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">Đổi mật khẩu</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
					<div class="form-group">
						<span id="admin-password-error" class="error"></span>
						<input type="password" name="admin_password" class="form-control" placeholder="Mật khẩu" data-modalfocus>
					</div>
					<div class="form-group">
						<input type="password" name="admin_password_confirmed" class="form-control" placeholder="Nhập lại mật khẩu">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btn_admin_change_password" data-url="{{url('admin/admins/change-password')}}">Đổi mật khẩu</button>
				</div>
			</div>
		</div>
	</div>
	<form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
    </form>
    <input type="hidden" name="url" id="url" value="{{url('/')}}">
	{{Html::script('public/bower_components/jquery/dist/jquery.min.js')}}
	{{Html::script('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}
	{{Html::script('public/lumino/js/common.js')}}
	@stack('scripts')
		
</body>

</html>
