(function($) {
	"use strict";
	console.log('front');
	/*========================================================
	  *  MENU  sourse: https://github.com/marioloncarek/megamenu-js
	========================================================*/
	$('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
	//Checks if li has sub (ul) and adds class for toggle icon - just an UI

	$('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
	//Checks if drodown menu's li elements have anothere level (ul), if not the dropdown is shown as regular dropdown, not a mega menu (thanks Luka Kladaric)

	$(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\">Navigation</a>");

	//Adds menu-mobile class (for mobile toggle menu) before the normal menu
	//Mobile menu is hidden if width is more then 959px, but normal menu is displayed
	//Normal menu is hidden if width is below 959px, and jquery adds mobile menu
	//Done this way so it can be used with wordpress without any trouble

	$(".menu > ul > li").hover(function(e) {
		if ($(window).width() > 943) {
			$(this).children("ul").stop(true, false).fadeToggle(150);
			e.preventDefault();
		}
	});
	//If width is more than 943px dropdowns are displayed on hover

	$(".menu > ul > li").click(function() {
		if ($(window).width() <= 943) {
			$(this).children("ul").fadeToggle(150);
		}
	});
	//If width is less or equal to 943px dropdowns are displayed on click (thanks Aman Jain from stackoverflow)

	$(".menu-mobile").click(function(e) {
		$(".menu > ul").toggleClass('show-on-mobile');
		e.preventDefault();
	});
	//when clicked on mobile-menu, normal menu is shown as a list, classic rwd menu story (thanks mwl from stackoverflow)

	/*========================================================
			*		HEADER валюта перевод
			========================================================*/
		$('.location, .currency').on("click", ".dropdown-toggle", function(e) {
			$(this).find('.dropdown-menu').addClass("open");
			e.stopPropagation();
		});

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
	  *  
	========================================================*/
	// function hydratex_total_sum() {
	// 	var total = 0;
	// 	$('.table > tbody > tr').each(function() {
	// 		var price = Number($(this).find('td.pricecol').data('sortValue'));
	// 		var count = Number($(this).find('td.qtycol > input').val());
	// 		var sum = price * count;
	// 		total += sum;
	// 	});
	// 	console.log(total);
	// 	$('#total-price').text(total);
	// }
	// $('input.qty').on('change', function() {
	// 	hydratex_total_sum();
	// });
	// function hydratex_total_sum() {
	// 	var total = 0;
	// 	jQuery(".table > tbody > tr").each(function() {
	// 		var price = Number($(this).find("td.pricecol").data("sortValue"));
	// 		var count = Number($(this).find("td.qtycol > input").val());
	// 		var sum = price * count;
	// 		total += sum;
	// 	});
	// 	console.log(total);
	// 	jQuery("#total-price").text(total);
	// }
	// jQuery("input.qty").on("change", function() {
	// 	console.log("111");
	// 	hydratex_total_sum();
	// });
	/*========================================================
			*		карусель
			========================================================*/
	// $('.carousel').carousel({
	// 	interval: 200000000
	// });
	// $('.carousel').one('click', '.carousel-control-next,.carousel-control-prev', function(e) {
	// 	var elem = $(this).parent().find('.carousel-inner');
	// 	var carousel = $(this).parent();
	// 	var id = $(this).parents('.product').children('.add_to_cart_button,.ajax_add_to_cart').data('product_id');
	// 	var data = {
	// 		action: 'add_in_element',
	// 		idProduct: id
	// 	};
	// 	jQuery.post(frontAjax.url, data, function(response) {
	// 		elem.append(response);
	// 		if (e.currentTarget.className == 'carousel-control-next') carousel.carousel('next');
	// 		else carousel.carousel('prev');
	// 	});
	// });

	// $('.carousel-control-next').on('click', function() {
	// 	$(this).parent().carousel('next');
	// });
	// $('.carousel-control-prev').on('click', function() {
	// 	$(this).parent().carousel('prev');
	// });

	// jQuery('.owl-carousel').owlCarousel({
	// 	loop: true,
	// 	margin: 10,
	// 	navText: ['<a class="carousel-control-prev"  role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>',
	// 		'<a class="carousel-control-next"  role="button" data-slide="next"><span class="carousel-control-next-icon"aria-hidden="true"></span></a>'
	// 	],
	// 	nav: true,
	// 	responsive: {
	// 		0: {
	// 			items: 1
	// 		},
	// 		600: {
	// 			items: 3,
	// 		},
	// 		1000: {
	// 			items: 5,
	// 		},
	// 		1200: {
	// 			items: 8,
	// 		}
	// 	}
	// });
	/*========================================================
  *  Сайдбар
========================================================*/
	// if (document.getElementById('secondary')) {
	// 	var sidebar = new StickySidebar('#secondary', {
	// 		containerSelector: '#content-box',
	// 		innerWrapperSelector: '.sidebar__inner',
	// 		topSpacing: 20,
	// 		bottomSpacing: 20
	// 	});
	// }

	/*========================================================
	  *  Обновить корзину по увеличению количество товара 
	========================================================*/
// 	var update_cart;
// 	jQuery('body').delegate(".cart_item .qty").on("change", function() {
// 		if (update_cart != null) {
// 			clearTimeout(update_cart);
// 		}
// 		update_cart = setTimeout(() => {
// 			jQuery(".cart_item").parents('form').find('[name="update_cart"]').trigger('click');
// 		}, 1500);
// 	});


// })(jQuery);


	/*========================================================
	  *  Заменить на ютюб
	========================================================*/
// function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
// r(function(){
//     if (!document.getElementsByClassName) {
//         // Поддержка IE8
//         var getElementsByClassName = function(node, classname) {
//             var a = [];
//             var re = new RegExp('(^| )'+classname+'( |$)');
//             var els = node.getElementsByTagName("*");
//             for(var i=0,j=els.length; i<j; i++)
//                 if(re.test(els[i].className))a.push(els[i]);
//             return a;
//         }
//         var videos = getElementsByClassName(document.body,"youtube");
//     } else {
//         var videos = document.getElementsByClassName("youtube");
//     }

//     var nb_videos = videos.length;
//     for (var i=0; i<nb_videos; i++) {
//         // Зная идентификатор видео на YouTube, легко можно найти его миниатюру
//         videos[i].style.backgroundImage = 'url(http://i.ytimg.com/vi/' + videos[i].id + '/sddefault.jpg)';

//         // Добавляем иконку Play поверх миниатюры, чтобы было похоже на видеоплеер
//         var play = document.createElement("div");
//         play.setAttribute("class","play");
//         videos[i].appendChild(play);

//         videos[i].onclick = function() {
//             // создаем iframe со включенной опцией autoplay
//             var iframe = document.createElement("iframe");
//             var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
//             if (this.getAttribute("data-params")) iframe_url+='&'+this.getAttribute("data-params");
//             iframe.setAttribute("src",iframe_url);
//             iframe.setAttribute("frameborder",'0');

//             // Высота и ширина iframe должны быть такими же, как и у родительского блока
//             iframe.style.width  = this.style.width;
//             iframe.style.height = this.style.height;

//             // Заменяем миниатюру плеером с YouTube
//             this.parentNode.replaceChild(iframe, this);
//         }
//     }
// });
	/*========================================================
	  *  копия но на jQuery
	========================================================*/

// (function($) {
// 	"use strict";
// 	    $(".youtube").each(function() {
//         // Зная идентификатор видео на YouTube, легко можно найти его миниатюру
//         $(this).css('background-image', 'url(http://i.ytimg.com/vi/' + this.id + '/sddefault.jpg)');
//         // Добавляем иконку Play поверх миниатюры, чтобы было похоже на видеоплеер
//         $(this).append($('<div/>', {'class': 'play'}));

//         $(document).delegate('#'+this.id, 'click', function() {
//             // создаем iframe со включенной опцией autoplay
//             var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
//             if ($(this).data('params')) iframe_url+='&'+$(this).data('params');

//             // Высота и ширина iframe должны быть такими же, как и у родительского блока
//             var iframe = $('<iframe/>', {'frameborder': '0', 'src': iframe_url, 'width': $(this).width(), 'height': $(this).height() })

//             // Заменяем миниатюру HTML5 плеером с YouTube
//             $(this).replaceWith(iframe);
//         });
//     });
// })(jQuery);

})(jQuery);
