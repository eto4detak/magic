(function($) {
	/*========================================================
			*		HEADER валюта перевод
			========================================================*/
	/*	$('.location, .currency').on("click", ".dropdown-toggle", function(e) {
			$(this).find('.dropdown-menu').addClass("open");
			e.stopPropagation();
		});*/

	$('.dropdown-menu').on('click', 'li', function(e) {
		var currency = $(this).data('value');
		$(this).parent().removeClass('open').parent().find(':first').text(currency);
		var loco = {
			'Russian': 'ru_RU',
			'English': 'en_US'
		};
		if (currency === 'Russian' || currency === 'English') {
			var date = new Date(new Date().getTime() + 60 * 60 * 24);
			document.cookie = "l=" + loco[currency] + "; path=/; expires=" + date;
			location.reload()
		}
		e.stopPropagation();
	});
	/*========================================================
			*		карусель
			========================================================*/
	$('.carousel').carousel({
		interval: 200000000
	});
	$('.carousel').one('click', '.carousel-control-next,.carousel-control-prev', function(e) {
		var elem = $(this).parent().find('.carousel-inner');
		var carousel = $(this).parent();
		var id = $(this).parents('.product').children('.add_to_cart_button,.ajax_add_to_cart').data('product_id');
		var data = {
			action: 'add_in_element',
			idProduct: id
		};
		jQuery.post(frontAjax.url, data, function(response) {
			elem.append(response);
			if (e.currentTarget.className == 'carousel-control-next') carousel.carousel('next');
			else carousel.carousel('prev');
		});
	});

	$('.carousel-control-next').on('click', function() {
		$(this).parent().carousel('next');
	});
	$('.carousel-control-prev').on('click', function() {
		$(this).parent().carousel('prev');
	});

})(jQuery);