console.log("test");

// 'use strict';
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


// youtube для скачки диномически

// "use strict";
// $(function() {
//     $(".youtube").each(function() {
//         // Зная идентификатор видео на YouTube, легко можно найти его миниатюру
//         $(this).css('background-image', 'url(http://i.ytimg.com/vi/' + this.id + '/sddefault.jpg)');
//         console.log($);
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
//  });

