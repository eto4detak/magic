
<?php 

/*========================================================
		==1== wp http api
		========================================================*/
function ReuestHttp( $id =0 ) {
	$url = 'http://httpbin.org/get';//GET
	$url_post = 'https://radiopotok.ru/';//POST
	$params = array(
		'foo' => 'значение 1',
		'bar' => 10
	);
	$args = array(
		'timeout' => 5,
		'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
	);
	$params = urlencode_deep( $params );//GET
	$url = add_query_arg( $params, $url );//GET
	// $args = array('body' => array('foo' => 'значение 1','bar' => 10,),'timeout' => '5',);//POST
	$response = wp_remote_post( $url_post, $args );//POST
	// $response = wp_remote_get( $url, $args );//GET
	$content_type = wp_remote_retrieve_header( $response, 'content-type' );
	$response_code = wp_remote_retrieve_response_code( $response ); //> 200
	$response_message = wp_remote_retrieve_response_message( $response );
	$response_body = wp_remote_retrieve_body( $response );
	// $body    = json_decode(wp_remote_retrieve_body( $response ));

	vardump( $content_type );
	vardump( $response_code );
	vardump( $response_message );
	vardump( $response_body );

	// $xml = simplexml_load_string($body); // парсим XML данные
	// $data = json_decode(json_encode($xml)); // превратим в обычный объект
	// $USD = wp_list_filter( $data->Valute, array('CharCode'=>'USD') ); // получим только данные USD

		if ( 200 != $response_code && ! empty( $response_message ) )
			return new WP_Error( $response_code, $response_message );
		elseif ( 200 != $response_code )
			return new WP_Error( $response_code, 'Неизвестная ошибка' );
		elseif( ! $response_body )
			return new WP_Error( 'nodata', 'Нет данных о фильме или такого фильма нет в базе' );
		else
			return $response_body;
}
// ReuestHttp();
 ?>


 <?php
/*========================================================
		==2== php http api
		========================================================*/
/**
* Curl send get request, support HTTPS protocol
* @param string $url The request url
* @param string $refer The request refer
* @param int $timeout The timeout seconds
* @return mixed
*/
function getRequest($url, $refer = "", $timeout = 10)
{
    $ssl = stripos($url,'https://') === 0 ? true : false;
    $curlObj = curl_init();
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_AUTOREFERER => 1,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
        CURLOPT_HTTPHEADER => ['Expect:'],
        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
    ];
    if ($refer) {
        $options[CURLOPT_REFERER] = $refer;
    }
    if ($ssl) {
        //support https
        $options[CURLOPT_SSL_VERIFYHOST] = false;
        $options[CURLOPT_SSL_VERIFYPEER] = false;
    }
    curl_setopt_array($curlObj, $options);
    $returnData = curl_exec($curlObj);
    if (curl_errno($curlObj)) {
        //error message
        $returnData = curl_error($curlObj);
    }
    curl_close($curlObj);
    return $returnData;
}

/**
* Curl send post request, support HTTPS protocol
* @param string $url The request url
* @param array $data The post data
* @param string $refer The request refer
* @param int $timeout The timeout seconds
* @param array $header The other request header
* @return mixed
*/
function postRequest($url, $data, $refer = "", $timeout = 10, $header = [])
{
    $curlObj = curl_init();
    $ssl = stripos($url,'https://') === 0 ? true : false;
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_AUTOREFERER => 1,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
        CURLOPT_HTTPHEADER => ['Expect:'],
        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        CURLOPT_REFERER => $refer
    ];
    if (!empty($header)) {
        $options[CURLOPT_HTTPHEADER] = $header;
    }
    if ($refer) {
        $options[CURLOPT_REFERER] = $refer;
    }
    if ($ssl) {
        //support https
        $options[CURLOPT_SSL_VERIFYHOST] = false;
        $options[CURLOPT_SSL_VERIFYPEER] = false;
    }
    curl_setopt_array($curlObj, $options);
    $returnData = curl_exec($curlObj);
    if (curl_errno($curlObj)) {
        //error message
        $returnData = curl_error($curlObj);
    }
    curl_close($curlObj);
    return $returnData;
}

// $getRes = getRequest("https://secure.php.net/");
// echo $getRes;//Get index page html of php.net

// $postRes = postRequest("https://radiopotok.ru/",[]);

// vardump($postRes);
?>




		<?php
/*========================================================
		 ==3== минимализм
		========================================================*/

/*$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://api.kinopoisk.cf/getFilm?filmID=884634");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);*/
?>