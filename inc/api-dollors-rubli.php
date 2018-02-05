<?php 

$transient = 'one_usd_in_rub'; // название временной опции

$usd_in_rub = get_transient( $transient ); // пробудем получить сохраненные данные

// если данных нет, или они просрочены, получим и сохраним их
if( ! $usd_in_rub ){
	$url = 'http://www.cbr.ru/scripts/XML_daily.asp';
	$expiration = DAY_IN_SECONDS / 2; // время жизни кэша - пол дня

	$resp = wp_remote_get( $url ); // получим данные

	// если статус ответа 200 - ОК
	if( wp_remote_retrieve_response_code($resp) === 200 ){
		$body = wp_remote_retrieve_body( $resp );

		$xml = simplexml_load_string($body); // парсим XML данные
		$data = json_decode(json_encode($xml)); // превратим в обычный объект

		// print_r( $data );

		$USD = wp_list_filter( $data->Valute, array('CharCode'=>'USD') ); // получим только данные USD
		$USD = array_shift($USD);

		/*
		stdClass Object (
			[NumCode] => 840
			[CharCode] => USD
			[Nominal] => 1
			[Name] => Доллар США
			[Value] => 64,0165
		)
		*/

		// echo "$USD->Nominal $USD->Name равен $USD->Value руб."; //> 1 Доллар США равен 64,0165 руб. 

		$usd_in_rub = $USD->Value;
	}
	// статус ответа не 200 - ОК
	else
		$usd_in_rub = 'нет данных';

	// сохраним курс доллара во временную опцию
	set_transient( $transient, $usd_in_rub, $expiration );
}

echo 'Курс доллара к рублю на сегодня: $1 = '. $usd_in_rub .' руб.';
//> Курс доллара к рублю на сегодня: $1 = 64,0165 руб.


 ?>