<?php 

// function kama_content_advertise($text){
// //спустя сколько символов искать перенос строки и вставлять рекламу?
//     $nu = 4000;
// //Код рекламы
//     $adsense =  '
// <div style="float:none;margin:0px 0px 10px 0px;">

// <ins class="adsbygoogle"
//      style="display:inline-block;width:728px;height:90px"
//      data-ad-client="ca-pub-6655900053997841"
//      data-ad-slot="3489536764"></ins>

// </div>';
//     //    return str_replace('<!--more-->', $adsense.'<!--more-->', $text);
//     return preg_replace('@([^^]{'.$nu.'}.*?)(\r?\n\r?\n|
// )@', "\\1$adsense\\2", trim($text), 1);
// }

// add_filter('the_content', 'kama_content_advertise', -10); 