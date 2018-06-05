
//для меню заменящее селект в карточке товара 
(function($) {
		  //свернуть общее меню при клике вне меню
	$(document).mouseup(function (e) {
    var container = $(".bounceInDown .animated-menu .sub-menu ul.animated-menu");
    if (container.has(e.target).length === 0){
        container.hide();
        container.closest(".bounceInDown").attr("style","");
    }
	});

   //меню поверх других при клике
	$(".bounceInDown").click(function(event) {
			$(this).attr("style","z-index:400");
	});
	$('a.reset_variations').click(function(event) {
		var vv = $(this).siblings('select').find(`[value='']`).text();
		$('nav.bounceInDown').each(function(index, el) {
			//var v = $(`#${taxonomy} [value='${attr}']`).text();
			$(this).find('.menu-select-value').text(vv);
		});
	});
//	$('.sub-menu ul.animated-menu').hide();
//убраить/вернуть пункты меню под вариации
	$(".bounceInDown .sub-menu a").click(function () {

		var attr = $(this).data('attr');
		var taxonomy = $(this).data('taxonomy');
		if(  !!taxonomy){

			$(`#${taxonomy} [value='${attr}']`).attr("selected", "selected");
			$( `#${taxonomy}` ).trigger( "change" );
			var vName = $(`#${taxonomy} [value='${attr}']`).text();
			if(!!vName) {
				$(this).closest(".animated > ul.animated-menu").find('.menu-select-value').text(vName);
				    var container = $(".bounceInDown .animated-menu .sub-menu ul.animated-menu");
				    container.each(function(index, el) {
				    	        container.hide();
	        container.closest(".bounceInDown").attr("style","");
				    });
			}
			function hideGeneral(link) {//убрать обложку нескольких элементов, если все элементы скрыты
				$('.bounceInDown .sub-menu .sub-menu').each(function(index, el) {
					var $liGeneral =	$(this);
				var ul =	$(this).find('.animated-menu');
				var flagObj = false;
				ul.find('a.attr-select').each(function(index, el) {
					if(!$(this).attr('style'))  flagObj = flagObj || true;
				});
				if(flagObj) $liGeneral.attr('style','');
				else $liGeneral.attr('style','display:none');
				});

			// var style = link.attr('style');
			// var v =link.data('attr');
			// 		var linksOpen = [];                    
			// 		link.parent().siblings('li').each(function(index, el) {  //каждый li
			// 		var st = $(this).children().attr('style');
			// 		var vv = $(this).children().data('attr');
			// 			if($(this).children().attr('style')) linksOpen.push(1);
			// 			else linksOpen.push(0);
			// 		});

			// 		var flagOpen = false;
			// 		for (var i = 0; i < linksOpen.length; i++) {
			// 			flagOpen = flagOpen || linksOpen[i];
			// 		}
			// 		//провреить обложку открыть/скрыть
			// 		var elGeneral = link.closest(".sub-menu .sub-menu");

			// 		if(flagOpen) elGeneral.attr('style','display:none');
			// 		else elGeneral.attr('style','');
					
		}
		jQuery.each($(".bounceInDown"), function function_name(i,val) {//каждое меню

			var menu = $(this);
			var link;
			var options = [];
			var optionsName = [];
			menu.siblings('select').children('option').each(function(index, elOption) {//каждый option из селекта
				options.push($(this).val());
			});
			menu.find('.attr-select').each(function(indexA, elA) {//каждая ссылка из меню
				//провреить элемент открыть/скрыть
				link = $(this);
				if(options.indexOf( link.data('attr')) > -1){//есть ссылка в селекте?
					link.attr('style','');//открыть элемент
          hideGeneral(link);
				}else{
					link.attr('style','display:none');//убрать элемент если нет вариации
          hideGeneral(link);
				}
			});
		}); 
	}

  $(this).parent(".sub-menu").children("ul.animated-menu").slideToggle("100");
  $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});
})(jQuery);
