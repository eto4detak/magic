jQuery(document).ready(function($) {



	var $companyInfo = $('.company-info');

	// Добавляет бокс с вводом адреса фирмы
	$('.add-company-address', $companyInfo).click(function() {
		var $list = $('.item-address').parent();
		$item = $list.find('.item-address').first().clone();
		$item.find('input').val('');
		$list.append($item);
	});

	// Удаляет бокс с вводом адреса фирмы
	$companyInfo.on('click', '.remove-company-address', function() {
		if ($('.item-address').length > 1) {
			$(this).closest('.item-address').remove();
		} else {
			$(this).closest('.item-address').find('input').val('');
		}
	});

});