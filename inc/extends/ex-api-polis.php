<?php 

 function GetPolis($polis='Аст')
{
		$transient = 'one_value_region'; // название временной опции

	$value_region = get_transient( $transient ); // пробудем получить сохраненные данные

	// если данных нет, или они просрочены, получим и сохраним их
	if( true){
		$url = 'https://api.exline.systems/public/v1/regions/origin?title=' . $polis;
		$expiration = DAY_IN_SECONDS / 2; // время жизни кэша - пол дня

		$resp = wp_remote_get( $url ); // получим данные

		// если статус ответа 200 - ОК
		if( wp_remote_retrieve_response_code($resp) === 200 ){
			$body = wp_remote_retrieve_body( $resp );
			//$xml = simplexml_load_string($body); // парсим XML данные
		//	$data = json_decode(json_encode($xml)); // превратим в обычный объект
    $data = json_decode($body); // превратим в обычный объект
    $value_region = "";
    foreach ($data->regions as $key => $value) {
    	$value_region .= $value->title . " ";
    }
		}
		// статус ответа не 200 - ОК
		else
			$value_region = 'нет данных';

		// сохраним курс доллара во временную опцию
		set_transient( $transient, $value_region, $expiration );
	}

	return 'Все города: '. $value_region;
}

 function GetPolis2($polis='Аст')
{
		$transient = 'one_value_region'; // название временной опции

	$value_region = get_transient( $transient ); // пробудем получить сохраненные данные

	// если данных нет, или они просрочены, получим и сохраним их
	if( true){
		$url = 'https://api.exline.systems/public/v1/regions/origin?title=' . $polis;
		$expiration = DAY_IN_SECONDS / 2; // время жизни кэша - пол дня

		$resp = wp_remote_get( $url ); // получим данные

		// если статус ответа 200 - ОК
		if( wp_remote_retrieve_response_code($resp) === 200 ){
			$body = wp_remote_retrieve_body( $resp );
			//$xml = simplexml_load_string($body); // парсим XML данные
		//	$data = json_decode(json_encode($xml)); // превратим в обычный объект
    $data = json_decode($body); // превратим в обычный объект
    $value_region = "";
    foreach ($data->regions as $key => $value) {
    	$value_region .= $value->title . " ";
    }
		}
		// статус ответа не 200 - ОК
		else
			$value_region = 'нет данных';

		// сохраним курс доллара во временную опцию
		set_transient( $transient, $value_region, $expiration );
	}

	return 'Все города: '. $value_region;
}


 ?>