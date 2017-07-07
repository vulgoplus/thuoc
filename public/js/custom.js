$('#banner').owlCarousel({
    items: 1,
    autoplay: true,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    loop: true,
    responsive: {
        768: {
            nav: true,
            dots: true
        }
    }
});

$('#featured').owlCarousel({
    items: 1,
    dots: false,
    loop: true,
    responsive: {
        768: {
            items: 2
        },
        992: {
            items: 3
        }
    }
});

$('.slider').owlCarousel({
    items: 1,
    loop: true
});

$('.normal-carousel').owlCarousel({
    items: 1,
    dots: false,
    nav: true,
    loop: true,
    navText: ['<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>'],
    responsive: {
        768: {
            items: 2
        },
        992: {
            items: 3
        }
    }
});

$('#branch').owlCarousel({
    items: 5,
    dots: false,
    autoWidth: true,
    autoplay: true,
    loop: true,
    autoplaySpeed: 1000
});

$(document).ready(function(){
    $('.menu').hover(function(){
        $('.sub-menu').removeClass('disable').addClass('fadeIn');
    }, function(){
        setTimeout(function(){
            if(!$('.menu').is(':hover')){
                $('.sub-menu').addClass('disable');
            }
        },500);
    });

    var sidebarPos = $('.sidebar').offset().top - 5;
    var sidebarWidth = $('.sidebar').width();
    
    var scrollBot = 0;
    var bottom = $('footer').height() + $('.footer').height() + 30;
    $('.sidebar').width(sidebarWidth);
    $(window).scroll(function(){
        scrollBot = $(document).height() - $(window).scrollTop() - $(window).height();
        if(scrollBot <= bottom){
            $('.sidebar').addClass('affix-bottom').removeClass('affix-top');
        }else if($(window).scrollTop() > sidebarPos && scrollBot > bottom){
            $('.sidebar').addClass('affix-top').removeClass('affix-bottom');
        }else{
            $('.sidebar').removeClass('affix-bottom').removeClass('affix-top');
        }
    });

    //Add to cart effect
    $('.add-to-cart').click(function(e){
        e.preventDefault();
        var url = $(this).data('target');
        var btnCart = $(this);
        
        $.ajax({
            url: url,
            method: 'GET',
            success: function(data){
                var cart = $('#cart-mumber');
                var imgToDrag = btnCart.parents('.prd').find('img').eq(0);
                $('#cart-mumber').text(data);
                if(imgToDrag){
                    var imgclone = imgToDrag.clone()
                        .offset({
                        top: imgToDrag.offset().top,
                        left: imgToDrag.offset().left
                    }).css({
                        'opacity': '0.5',
                        'position': 'absolute',
                        'z-index': '100',
                        'width' : 200,
                        'height' : 200
                    }).appendTo($('body')).animate({
                        'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 1500);

                    imgclone.animate({
                        'width': 0,
                        'height': 0
                    }, function () {
                        $(this).detach()
                    });
                }
            },
            error: function(){
                alert('Đã có lỗi xảy ra!');
            }
        });
    });


    $('.like').click(function(e){
        e.preventDefault();
        var x = $(this);
        var active = $(this).hasClass('active');
        var productId = $(this).data('product');
        var userId = $(this).data('auth');

        if($(this).data('auth')=='no'){
            return false;
        }

        $.ajax({
            url: $('#url').val() + '/like',
            method: 'POST',
            dataType: 'TEXT',
            data: {
                productId : productId,
                userId : userId,
                active : active?'1':'0',
                _token: $('input[name="_token"]').val()
            },
            success: function(data){
                x.toggleClass('active');
                if(active){
                    x.html('<i class="fa fa-heart-o"></i>');
                }else{
                    x.html('<i class="fa fa-heart"></i>');
                }
            },
            error: function(){
                alert('Có lỗi xảy ra!');
            }
        });
    });

    $('#search-input').autocomplete({
        source: function(request, response){
            $.ajax({
                url: $('#url').val() + '/autocomplete',
                dataType: "JSON",
                method: 'POST',
                data: {
                    q: request.term,
                    _token: $('input[name="_token"]').val()
                },
                success: function( data ) {
                    response( data );
                    console.log(data);
                }
            });
        },
        minLength: 2
    });

    $('.move-up').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
    });

    $(window).scroll(function(){
        if($(this).scrollTop() > 300){
            $('.move-up').removeClass('hidden');
        }else{
            $('.move-up').addClass('hidden');
        }
    });
});