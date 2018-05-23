// (function() {
// 	console.log('==============================================');
// 		  //свернуть общее меню при клике вне меню
// 	$(document).mouseup(function (e) {
//     var container = $(".bounceInDown .animated-menu .sub-menu ul.animated-menu");
//     if (container.has(e.target).length === 0){
//         container.hide();
//         container.closest(".bounceInDown").attr("style","z-index:200");
//     }
// 	});

//    //меню поверх других при клике
// 	$(".bounceInDown").click(function(event) {
// 			$(this).attr("style","z-index:400");
// 	});

// 	$('.sub-menu ul.animated-menu').hide();
// //убраить/вернуть пункты меню под вариации
// 	$(".bounceInDown .sub-menu a").click(function () {
		
// 		var attr = $(this).data('attr');
// 		var taxonomy = $(this).data('taxonomy');
// 		if(  taxonomy != ''){

// 		$(`#${taxonomy} [value='${attr}']`).attr("selected", "selected");
// 		$( `#${taxonomy}` ).trigger( "change" );
// 		var vName = $(`#${taxonomy} [value='${attr}']`).text();
// 		if(!!vName)  $(this).closest(".animated > ul.animated-menu").find('.menu-select-value').text(vName);
		
// 		jQuery.each($(".bounceInDown"), function function_name(i,val) {//каждое меню

// 			var menu = $(this);
// 			var link;
// 			var options = [];
// 			var optionsName = [];
// 			menu.siblings('select').children('option').each(function(index, elOption) {//каждый option из селекта
// 				options.push($(this).val());
// 			});
// 			menu.find('.attr-select').each(function(indexA, elA) {//каждая ссылка из меню
// 				//провреить элемент открыть/скрыть
// 				link = $(this);
// 				if(options.indexOf( link.data('attr')) > -1){//есть в массиве?
// 					link.attr('style','');//открыть элемент

// 					var itemsLi = [];                    //убрать обложку нескольких элементов, если все элементы скрыты
// 					link.parent().siblings('li').each(function(index, el) {
// 						var rr = link.attr('style');
// 						if(!link.attr('style')) itemsLi.push(1);
// 						else itemsLi.push(0);
// 					});

// 					var flag = false;
// 					for (var i = 0; i < itemsLi.length; i++) {
// 						flag = flag || itemsLi[i];
// 					}

// 					//провреить обложку открыть/скрыть
// 					var elGeneral = link.closest(".sub-menu .sub-menu");
// 					var s = elGeneral;
// 					//console.log(link);
// 					if(!flag) {
// 						elGeneral.attr('style','display:none');
// 					}else{
// 						elGeneral.attr('style','');
// 					}
// 				}else{
// 					link.attr('style','display:none');//убрать элемент если нет вариации

// 					var itemsLi = [];                    //убрать обложку нескольких элементов, если все элементы скрыты
// 					link.parent().siblings('li').each(function(index, el) {
// 						var rr = link.attr('style');
// 						if(!link.attr('style')) itemsLi.push(1);
// 						else itemsLi.push(0);
// 					});

// 					var flag = false;
// 					for (var i = 0; i < itemsLi.length; i++) {
// 						flag = flag || itemsLi[i];
// 					}

// 					//провреить обложку открыть/скрыть
// 					var elGeneral = link.closest(".sub-menu .sub-menu");
// 					var s = elGeneral;
// 					if(!flag) {
// 						elGeneral.attr('style','display:none');
// 					}else{
// 						elGeneral.attr('style','');
// 					}
// 				}
// 			});

// 		}); 
// 	}

//   $(this).parent(".sub-menu").children("ul.animated-menu").slideToggle("100");
//   $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
// });
// })();
