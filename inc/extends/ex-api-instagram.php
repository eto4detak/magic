<?php 

/*
 * создаем новое подключение к API Instagram, о том, как получить $token, написано выше;
 */

 function GetInstagram($value='')
{
	$token = '7641967042.c1e404e.1fcdb358d38c4f4fb054f26fcb8b5a53';
/*
 * Тут указываем либо ID пользователя, либо "self" для вывода фото владельца токена
 * Как получить ID? Да в том же инструменте, в котором вы получали токен
 */
$user_id = '7641967042';
$instagram_cnct = curl_init(); // инициализация cURL подключения
curl_setopt( $instagram_cnct, CURLOPT_URL, "https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $token ); // подключаемся
curl_setopt( $instagram_cnct, CURLOPT_RETURNTRANSFER, 1 ); // просим вернуть результат
curl_setopt( $instagram_cnct, CURLOPT_TIMEOUT, 15 );

$media = json_decode( curl_exec( $instagram_cnct ) ); // получаем и декодируем данные из JSON
var_dump($media);
curl_close( $instagram_cnct ); // закрываем соединение
 
/*
 * количество фотографий для вывода
 */
$limit = 4;
/*
 * размер изображений (высота и ширина одинаковые)
 */
$size = 200;
/*
 * функция array_slice() задает количество элементов, которые нам нужно получить из массива
 * если нам нужно вывести все фото, тогда: foreach($media->data as $data) {
 */
foreach(array_slice($media->data, 0, $limit) as $data) {
	echo '<a href="' . $data->link . '" target="_blank">';
	echo '<img src="'. $data->images->low_resolution->url . '" height="'.$size.'" width="'.$size.'"/>';
	echo '</a>';
}
}
