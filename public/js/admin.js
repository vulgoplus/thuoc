$(document).ready(function(){
	/**
	* Generate slug for product
	*/
	$('#product-title').focusout(function(){
		if($(this).val().trim() != ''){
			$.ajax({
			    url: $('#url').val() + '/products/slug',
			    method: 'POST',
			    dataType: 'TEXT',
			    data: {
			        slug: $('input[name="title"]').val(),
			        _token: $('input[name="_token"]').val()
			    },
			    success: function(data){
			    	$('#slug').text('Chuỗi hiển thị: '+data).removeClass('hidden'); 
			    	$('input[name="slug"]').val(data);   
			    },
			    error: function(){
			        alert('Có lỗi xảy ra!');
			    }
			});
		}else{
			$('#slug').addClass('hidden');
		}
	});

	/**
	* Generate slug for post
	*/
	$('#post-title').focusout(function(){
		if($(this).val().trim() != ''){
			var data = {};
			if($('input[name="id"]').length > 0){
				data = {
				    slug: $('input[name="title"]').val(),
				    id: $('input[name="id"]').val(),
				    _token: $('input[name="_token"]').val()
				}
			}else{
				data = {
				    slug: $('input[name="title"]').val(),
				    _token: $('input[name="_token"]').val()
				}
			}
			$.ajax({
			    url: $('#url').val() + '/posts/slug',
			    method: 'POST',
			    dataType: 'TEXT',
			    data: data,
			    success: function(data){
			    	$('#slug').text('Chuỗi hiển thị: '+data).removeClass('hidden'); 
			    	$('input[name="slug"]').val(data);   
			    },
			    error: function(){
			        alert('Có lỗi xảy ra!');
			    }
			});
		}else{
			$('#slug').addClass('hidden');
		}
	});

	/**
	* Add taxonomy
	*/
	$('#btn_add_taxonomy').click(function(){
		if($(this).siblings('.form-group').hasClass('collapse')){
			$(this).siblings('.form-group').removeClass('collapse');
			$('#btn_cancel').removeClass('collapse');
			$('#taxonomy_name').focus();
		}else{
			if($('#taxonomy_name').val()=='')
				return false;
			$.ajax({
			    url: $('#url').val() + '/taxonomies/add',
			    method: 'POST',
			    dataType: 'JSON',
			    data: {
			        name: $('#taxonomy_name').val(),
			        _token: $('input[name="_token"]').val()
			    },
			    success: function(data){
			    	$element = '<option value="'+data.id+'" selected>'+data.name+'</option>';
			    	$('select[name="taxonomy_id"]').append($element);
			    	$('#btn_cancel').siblings('.form-group').addClass('collapse');
			    	$('#btn_cancel').addClass('collapse');
			    	$('#taxonomy_name').val('');
			    },
			    error: function(){
			        alert('Có lỗi xảy ra!');
			        $('#btn_cancel').siblings('.form-group').addClass('collapse');
			        $('#btn_cancel').addClass('collapse');
			        $('#taxonomy_name').val('');
			    }
			});
		}
	});

	/**
	* Add category
	*/
	$('#btn_add_category').click(function(){
		if($(this).siblings('.form-group').hasClass('collapse')){
			$(this).siblings('.form-group').removeClass('collapse');
			$('#btn_cancel').removeClass('collapse');
			$('#category_name').focus();
		}else{
			if($('#category_name').val()=='')
				return false;
			$.ajax({
			    url: $('#url').val() + '/categories/add',
			    method: 'POST',
			    dataType: 'JSON',
			    data: {
			        name: $('#category_name').val(),
			        parent: $('select[name="parent"]').val(),
			        _token: $('input[name="_token"]').val()
			    },
			    success: function(data){
			    	$element = '<option value="'+data.id+'" selected>'+data.name+'</option>';
			    	$('select[name="category_id"]').append($element);
			    	$('#btn_cancel').siblings('.form-group').addClass('collapse');
			    	$('#btn_cancel').addClass('collapse');
			    	$('#category_name').val('');
			    },
			    error: function(){
			        alert('Có lỗi xảy ra!');
			        $('#btn_cancel').siblings('.form-group').addClass('collapse');
			        $('#btn_cancel').addClass('collapse');
			        $('#category_name').val('');
			    }
			});
		}
	});

	/**
	* Cancel
	*/
	$('#btn_cancel').click(function(){
		$(this).addClass('collapse');
		$(this).siblings('.form-group').addClass('collapse');
	});

	/**
	* Preview image
	*/
	$('#image').change(function(){
		readURL(this,'#img');
	});

	/**
	* Trigger file input
	*/
	$('#btn-images').click(function(){
		$('#images').click();
	});

	/**
	* Count file uploaded
	*/
	$('#images').change(function(){
		var count = this.files.length;
		if(count > 0){
			$('#images-alert').text(count + ' files được chọn!');
		}else{
			$('#images-alert').text('Không có file nào được chọn!');
		}
	});

	/**
	* Trigger input file
	*/
	$('#upload').click(function(){
		$('#image-upload').click();
	});

	/**
	* Preview image
	*/
	$('#image-upload').change(function(){
		readURL(this, '#img');
	});

	/**
	* Delete slider
	*/
	$('.delete-slider').click(function(){
		var url = $(this).data('url');
		var x = $(this);
		if(confirm('Bạn có chắc muốn xóa?')){
			$.ajax({
			    url: url,
			    method: 'GET',
			    success: function(data){
			    	x.parents('.panel').remove();
			    },
			    error: function(){
			        alert('Có lỗi xảy ra!');
			    }
			});
		}
	});

	/**
	* Trigger input file
	*/
	$('.img-brower').click(function(){
		$(this).siblings('input[type="file"]').click();
	});

	/**
	* Preview image
	*/
	$('.slider-image').change(function(){
		displayImage(this, $(this).siblings('img'));
	});

	/**
	* Change click
	*/
	$('.change').click(function(){
		var id = $(this).data('id');
		$('#password').modal('show');
		$('input[name="id"]').val(id);
		$('#password-error').text('');
	});

	/**
	* Charge click
	*/
	$('.charge').click(function(){
		var id = $(this).data('id');
		$('input[name="id"]').val(id);
		$('input[name="balance"]').val('');
	});

	/**
	* Focus input on modal shown
	*/
	$('.modal').on('shown.bs.modal', function(){
		$('[data-modalfocus]', this).focus();
	});

	/**
	* Clear text error
	*/
	$('#txt-password').change(function(){
		$('#password-error').text('');
	});

	
	/**
	* Change password action
	*/	
	$('#btn-change-password').click(function(){
		var url = $(this).data('url');
		var data = {
			_token: $('input[name="_token"]').val(),
			password: $('input[name="password"]').val(),
			password_confirmed: $('input[name="password_confirmed"]').val(),
			id: $('#form-password input[name="id"]').val()
		}

		$.ajax({
		    url: url,
		    method: 'POST',
		    data: data,
		    success: function(data){
		    	$('#password').modal('hide');
		    },
		    error: function(data){
		       	$('#password-error').text('Có lỗi! Vui lòng kiểm tra lại!');
		    }
		});
	});

	/**
	* Clear balance error text
	*/ 
	$('input[name="balance"]').change(function(){
		$('#balance-error').text('');
	});


	/**
	* Increment blance action
	*/
	$('#btn-balance').click(function(){
		var url = $(this).data('url');

		$.ajax({
		    url: url,
		    method: 'POST',
		    data: {
		    	_token: $('input[name="_token"]').val(),
		    	balance: $('input[name="balance"]').val(),
		    	id: $('input[name="id"]').val()
		    },
		    success: function(data){
		    	$('#balance').modal('hide');
		    },
		    error: function(data){
		       	$('#balance-error').text('Có lỗi! Vui lòng kiểm tra lại!');
		    }
		});
	});
});

//Preview image function
function readURL(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(target).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function displayImage(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            target.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}