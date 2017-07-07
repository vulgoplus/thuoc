$(document).ready(function(){

    $('#image').elevateZoom();

    $('#rating').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: $('#rating').data('current-rating'),
        readonly: true
    });

    $('#rate').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: $('#rate').data('current-rating'),
    });

    $('.decrement').click(function(){
        var num = Number($(this).siblings('.qty').text());
        num--;
        if(num < 1){
            $(this).siblings('.qty').text(1);
            $(this).siblings('input').val(1);
        }else{
            $(this).siblings('.qty').text(num);
            $(this).siblings('input').val(num);
        }
    });

    $('.increment').click(function(){
        var num = Number($(this).siblings('.qty').text());
        num++;
        if(num > 99){
            $(this).siblings('.qty').text(99);
            $(this).siblings('input').val(99);
        }else{
            $(this).siblings('.qty').text(num);
            $(this).siblings('input').val(num);
        }
    });

    $('.v-tab').click(function(){
        var target = $(this).data('target');
        $('.v-tab').removeClass('active');
        $(this).addClass('active');

        $('.t-tab').addClass('hidden');
        $(target).removeClass('hidden');
    });

    $('#frmComment').submit(function(e){
        e.preventDefault();
        if(validateCommentForm()){
            $.ajax({
                url: $('#url').val() + '/comment',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    name: $('#frmComment input[name="name"]').val(),
                    content: $('#frmComment textarea[name="content"]').val(),
                    productID: $('#frmComment input[name="product_id"]').val(),
                    _token: $('input[name="_token"]').val()
                },
                success: function(data){
                    clearCommentForm();
                    $('#comments > p').remove();
                    var el =  '<div class="comment-item">';
                        el +=   '<strong>'+data.name+'</strong>';
                        el +=   '<small>vừa xong</small>';
                        el +=   '<p>'+data.content+'</p>';
                        el += '</div>';
                    $('#comments').append(el);
                },
                error: function(){
                    alert('Có lỗi xảy ra!');
                }
            });
        }
    });

    $('#frmComment input[name="name"]').change(function(){
        if($(this).val().trim() == '' ){
            $('#name-error').text('Vui lòng nhập tên!');
        }else{
            $('#name-error').text('');
        }
    });

    $('#frmComment textarea[name="content"]').change(function(){
        if($(this).val().trim() == '' ){
            $('#content-error').text('Vui lòng nhập nội dung!');
        }else{
            $('#content-error').text('');
        }
    });

    $('#rate').change(function(){
        $.ajax({
            url: $('#url').val() + '/rating',
            method: 'POST',
            data: {
                point: $('#rate').val(),
                product_id : $('input[name="product_id"]').val(),
                user_id: $('input[name="user_id"]').val(),
                _token: $('input[name="_token"]').val(),
            },
            success: function(data){
                $('#rating').barrating('set',data);
                $('#product-rate').text(data+'/5');
            },
            error: function(){
                alert('Có lỗi xảy ra!');
            }
        });
    });
});

function validateCommentForm(){
    var flag = true;
    if($('#frmComment input[name="name"]').val().trim() == ''){
        $('#name-error').text('Vui lòng nhập tên!');
        flag = false;
    }
    if($('#frmComment textarea[name="content"]').val() == ''){
        $('#content-error').text('Vui lòng nhập nội dung!');
        flag = false;
    }

    return flag;
}

function clearCommentForm(){
    $('#frmComment textarea[name="content"]').val('');
}

function currentDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();

    return dd+'/'+mm+'/'+yyyy;;
}