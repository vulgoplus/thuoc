<footer class="has-margin-top">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h2>Viliti</h2>
                <ul>
                    <li><span><i class="fa fa-map-marker"></i></span> Đường 32 - Phường Minh Khai - Bắc Từ Liêm - Hà Nội</li>
                    <li><span><i class="fa fa-mobile-phone"></i></span> 0166.898.3346</li>
                    <li><span><i class="fa fa-envelope-o"></i></span> vulgoplus@gmail.com</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Phản hồi</h2>
                <form action="{{url('feedback')}}" method="POST">
                    {{csrf_field()}}
                    <input type="text" name="name" placeholder="Họ tên" required="">
                    <input type="email" name="email" placeholder="Email" required="">
                    <textarea name="content" placeholder="Nội dung" rows="2" required=""></textarea>
                    <button><i class="fa fa-send"></i> Gửi</button>
                </form>
            </div>
            <div class="col-md-3 socials">
                <h2>Liên hệ</h2>
                <a href="#">{{Html::image('public/img/socials/face.png')}}</a>
                <a href="#">{{Html::image('public/img/socials/google.png')}}</a>
                <a href="#">{{Html::image('public/img/socials/skype.png')}}</a>
                <a href="#">{{Html::image('public/img/socials/twitter.png')}}</a>
                <ul>
                    <li><i class="fa fa-facebook-official"></i> <a href="https://www.facebook.com/vuongemperor">Bùi Văn Vương</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="footer text-center">
    <div class="container">
        Copyright &copy; 2017
    </div>
</div>

<div class="move-up hidden">
    <i class="fa fa-angle-up fa-2x"></i>
</div>

<script language="javascript">

    var f_chat_vs = "Viliti";

    var f_chat_domain =  "https://localhost:8888/project";    

    var f_chat_name = "Tư vấn sản phẩm";

    var f_chat_star_1 = "Chào bạn!";

    var f_chat_star_2 = 'Chúng tôi có thể giúp gì cho bạn?<br/><em>Gửi vài giây trước</em>';

    var f_chat_star_3 = "<a href='javascript:;' onclick='f_bt_start_chat()' id='f_bt_start_chat'>Bắt đầu Chat</a>";

    var f_chat_star_4 = "Chú ý: Bạn phải đăng nhập <a href='http://facebook.com/' target='_blank' rel='nofollow'>Facebook</a> mới có thể trò chuyện.";

    var f_chat_fanpage = "facebook"; /* Đây là địa chỉ Fanpage*/

    var f_chat_background_title = "#19c58b"; /* Lấy mã màu tại đây http://megapixelated.com/tags/ref_colorpicker.asp */

    var f_chat_color_title = "#fff";

    var f_chat_cr_vs = 21; /* Version ID */

    var f_chat_vitri_manhinh = "left:10px;"; /* Right: 10px; hoặc left: 10px; hoặc căn giữa left:45% */    

</script>

<!-- $Chat iCon Font (có thể bỏ) -->


<!-- $Chat Javascript (không được xóa) -->

<script src="https://hoangluyen.com/livechat/chat.js?vs=2.1"></script>

<!-- $Chat HTML (không được xóa) -->

<a title='Mở hộp Chat' id='chat_f_b_smal' onclick='chat_f_show()' class='chat_f_vt'><i class='fa fa-comments title-f-chat-icon'></i> Chat</a><div id='b-c-facebook' class='chat_f_vt'><div id='chat-f-b' onclick='b_f_chat()' class='chat-f-b' style="background: #19c58b"><i class='fa fa-comments title-f-chat-icon'></i><label id="f_chat_name"></label><span id='fb_alert_num'>1</span><div id='t_f_chat'><a href='javascript:;' onclick='chat_f_close()' id='chat_f_close' class='chat-left-5'>x</a></div></div><div id='f-chat-conent' class='f-chat-conent'><script>document.write("<div class='fb-page' data-tabs='messages' data-href='https://www.facebook.com/"+f_chat_fanpage+"' data-width='250' data-height='310' data-small-header='true' data-adapt-container-width='true' data-hide-cover='false' data-show-facepile='false' data-show-posts='true'></div>");</script><div id='fb_chat_start'><div id='f_enter_1' class='msg_b fb_hide'></div><div id='f_enter_2' class='msg_b fb_hide'></div><br/><p id='f_enter_3' class='fb_hide' align='center'><a href='javascript:;' onclick='f_bt_start_chat()' id='f_bt_start_chat'>Bắt đầu Chat</a></p><br/><p id='f_enter_4' class='fb_hide' align='center'></p></div><div id="f_chat_source" class='chat-single'></div></div></div>


@if(session('success'))
    <div class="notification notification-success animated slideInLeft">
        {{session('success')}}
    </div>
    <script type="text/javascript">
        setTimeout(function(){
            $('.notification').removeClass('slideInLeft').addClass('slideOutLeft');
        }, 3000);
    </script>
@endif