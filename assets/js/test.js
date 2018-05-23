'use strict';

    /*========================================================
      *  API IP
    ========================================================*/

(function(){
    'use strict';
  var name;
  console.log(name);
 // console.log(name.namme);
   var jqxhr = $.getJSON('//ipapi.co/json/', function(data) {
     console.log(JSON.stringify(data, null, 2));
    })
    .fail(function(data){
      console.log('запрос с ошибкой');
    });;
})();

(function(){
  var name;
  console.log("Second function");

})();


(function() {

// $.getJSON('http://ip-api.com/json?callback=?', function(data) {
//   console.log(JSON.stringify(data, null, 2));
// })
// .fail(function(data){
//       console.log('запрос с ошибкой');
//     });

//   $.getJSON('http://www.geoplugin.net/json.gp?jsoncallback', function(data) {
//   console.log(JSON.stringify(data, null, 2));
// })
// .fail(function(data){
//       console.log('запрос с ошибкой');
//     });;

// $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
//   console.log(JSON.stringify(data, null, 2));
// })
// .fail(function(data){
//       console.log('запрос с ошибкой');
//     });

   var flickerAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
   $.getJSON( flickerAPI, {
     tags: "mount rainier",
     tagmode: "any",
     format: "json"
   })
   .done(function( data ) {
  console.log( data);
   })
   .fail(function(data){//fail - при ошибке в запросе
              console.log('запрос с ошибкой');
          });;

//ОСТОРОЖНО
// var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})

// /*Usage example*/
// findIP.then(ip => document.write('your ip: ', ip)).catch(e => console.error(e))

})();

if (true) {

  sayHi(); // работает

  function sayHi() {
    console.log("Привет!");
  }

}

console.log('end test');


(function(){
  'use strict';
  console.log("test2.js");

  var tok = '7641967042.c1e404e.1fcdb358d38c4f4fb054f26fcb8b5a53', // я уже давал ссылку чуть выше
    userid = '7641967042', // ID пользователя, можно выкопать в исходном HTML, можно использовать спец. сервисы либо просто смотрите следующий пример :)
    kolichestvo = 4; // ну это понятно - сколько фоток хотим вывести
 
$.ajax({
  url: 'https://api.instagram.com/v1/users/' + userid + '/media/recent',
  dataType: 'jsonp',
  type: 'GET',
  data: {access_token: tok, count: kolichestvo}, // передаем параметры, которые мы указывали выше
  success: function(result){
    console.log(result);
    for( x in result.data ){
      $('ul').append('<li><img src="'+result.data[x].images.low_resolution.url+'"></li>'); // result.data[x].images.low_resolution.url - это URL картинки среднего разрешения, 306х306
      // result.data[x].images.thumbnail.url - URL картинки 150х150
      // result.data[x].images.standard_resolution.url - URL картинки 612х612
      // result.data[x].link - URL страницы данного поста в Инстаграм 
    }
  },
  error: function(result){
    console.log(result); // пишем в консоль об ошибках
  }
});
  console.log("finish test2.js");
})();

