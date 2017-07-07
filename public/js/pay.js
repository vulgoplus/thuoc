$(document).ready(function(){
	$('#coupon-toggle').change(function(e){
		if($(this).data('condition') == '0'){
			$('#coupon-toggle').prop('checked',false);
			$('.notification').text('Điểm thưởng của bạn không đủ!');
			$('.notification').removeClass('hidden').removeClass('slideOutLeft').addClass('slideInLeft');
			setTimeout(function(){
				$('.notification').removeClass('hidden').removeClass('slideInLeft').addClass('slideOutLeft');
			}, 3000);
		}
		var x = $('#coupon-toggle').prop('checked')?1:0;
		$('input[name="_coupon"]').val(x);
	});

	$('#vlt').click(function(){
		if($(this).data('condition') == '0'){
			$('.notification').text('Tài khoản của bạn không đủ!');
			$('.notification').removeClass('hidden').removeClass('slideOutLeft').addClass('slideInLeft');
			setTimeout(function(){
				$('.notification').removeClass('hidden').removeClass('slideInLeft').addClass('slideOutLeft');
			}, 3000);
			return false;
		}
	});

	$('input[name="payment"]').change(function(){
		$('input[name="_payment"]').val($(this).val());
	});
});