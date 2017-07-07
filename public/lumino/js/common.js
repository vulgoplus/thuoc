$(document).ready(function(){
    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
        $(this).find('em:first').toggleClass("glyphicon-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");

    $(window).on('resize', function () {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
      if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })

    /**
    * Toggle form add category when click
    */
    $('#btn-toggle').click(function(){
        $('.category-name').toggle();
    })


    /**
    * Add category
    */
    $('#add-category').click(function(e){
        var categoryName = $('input[name="category_name"]').val();
        var url = $(this).data('url');
        e.preventDefault();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: {
                category_name: categoryName,
                _token: $('input[name="_token"]').val()
            },
            success: function(data){
                var element = '<option value="'+data.id+'" selected>'+data.name+'</option>';
                $('select[name="category_id"]').append(element);
                $('input[name="category_name"]').val('');
                $('.category-name').hide();
            },
            error: function(){
                alert('Có lỗi xảy ra!');
            }
        });
    });

    /**
    * Check all checkbox
    */
    $('#check-all').change(function(){
        $('.select').prop('checked',$(this).prop('checked'));
    });

    /**
    * Toggle featured status
    */
    $('.featured').click(function(e){
        e.preventDefault();
        var x = $(this);
        var url = $(this).data('target');
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                status: x.hasClass('no-featured')?1:0,
                _token: $('input[name="_token"]').val()
            },
            success: function(){
                if(x.hasClass('no-featured')){
                    x.removeClass('no-featured').addClass('has-featured');
                }else{
                    x.addClass('no-featured').removeClass('has-featured');
                }
            },
            error: function(){
                alert('Có lỗi xảy ra!');
            }
        });
    });

    /**
    * Multiple delete item
    */
    $('.delete').click(function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var x = $(this)
        if(confirm("Bạn có chắc muốn xóa mục này!")){
            $.ajax({
                url: url,
                method: "DELETE",
                data:{
                    _token: $('input[name="_token"]').val(),
                },
                success: function(){
                    x.parents('tr').remove();
                },
                error: function(){
                    alert('Đã có lỗi xảy ra!');
                }
            });
        }
    });

    /**
    * Multiple delete item
    */
    $('#delete-items').click(function(){
        var id = [];
        $.each($('.select:checked'), function(){
            id.push($(this).val());
        });

        if(id.length === 0)
            return;

        if(confirm("Bạn có chắc muốn xóa những mục này!")){
            $.ajax({
                url: $('#delete-items').data('url'),
                method: "POST",
                data:{
                    _token: $('input[name="_token"]').val(),
                    id: id
                },
                success: function(){
                    $.each($('.select:checked'), function(){
                        $(this).parents('tr').remove();
                    });
                },
                error: function(){
                    alert('Đã có lỗi xảy ra!');
                }
            });
        }
    });

    $('.detail').click(function(){
        var content = $(this).siblings('.content').text();

        $('#feedback-content').text(content);

        $('#feedback').modal('show');
    });


    /**
    * Hide alert panel on click
    */
    // $('.close').click(function(e){
    //     e.preventDefault();
    //     $(this).parent().fadeOut();
    // });

    /* Display receiver name */
    $('select[name="status"]').change(function(){
        if($(this).val() == 1){
            $('#receiver').hide();
        }else{
            $('#receiver').show();
        }
    });

    $('.updateStatus').click(function(){
        var track_id = $(this).data('code');
        $('input[name="track_id"]').val(track_id);
    });

    $('#frmStatus').submit(function(){
        $('#dialog').modal('hide');
    });

    $('[data-toggle="tooltip"]').tooltip();


    $('input[name="admin_password"]').change(function(){
        $('#admin-password-error').text('');
    });

    /**
    * Focus input on modal shown
    */
    $('.modal').on('shown.bs.modal', function(){
        $('[data-modalfocus]', this).focus();
    });

    $('#btn_admin_change_password').click(function(){
        var url = $(this).data('url');
        var data = {
            _token: $('input[name="_token"]').val(),
            password: $('input[name="admin_password"]').val(),
            password_confirmed: $('input[name="admin_password_confirmed"]').val(),
            id: $('input[name="admin_id"]').val()
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function(data){
                $('#admin-password').modal('hide');
            },
            error: function(data){
                $('#admin-password-error').text('Có lỗi! Vui lòng kiểm tra lại!');
            }
        });
    });

    $('.order-status').click(function(){
        var status = $(this).hasClass('queue')?1:0;
        var orderID = $(this).data('id');
        var parent = $(this).parent();

        $.ajax({
            url: $('#url').val() + '/admin/orders/change-status',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                status: status,
                order_id: orderID
            },
            success: function(data){
                if(status == 0){
                    parent.html('<span class="queue round-corner order-status" data-id="'+orderID+'">Đang đợi</span>');
                }else{
                    parent.html('<span class="round-corner successful order-status" data-id="'+orderID+'">Thành công</span>');
                }
            },
            error: function(data){
                alert('Có lỗi xảy ra!');
            }
        });
    });
});

