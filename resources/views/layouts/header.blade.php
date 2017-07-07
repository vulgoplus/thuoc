<div class="container">
    <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="7" direction="left" width="200px" style="padding-top:4px; color: #fff; margin-top: 15px" align="center">
        Mọi chi tiết xin liên hệ 0166.898.3346 hoặc vulgoplus@gmail.com! Xin chân thành cảm ơn                 
    </marquee>
    <ul>
        <li><a href="{{url('tin-tuc')}}">Tin tức</a></li>
        <li><a href="{{url('trang/gioi-thieu')}}">Giới thiệu</a></li>
        <li><a href="{{url('lien-he')}}">Liên hệ</a></li>
        @if(Auth::check())
            <li><a href="{{url('yeu-thich')}}">Yêu thích</a></li>
            <li><a href="{{url('thong-tin')}}">Thông tin</a></li>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
        @else
            <li><a href="{{url('register')}}">Đăng ký</a></li>
            <li><a href="{{url('login')}}">Đăng nhập</a></li>
        @endif
    </ul>
</div> {{-- /.container --}}