
<?php

## Создает CSV файл из переданных в массиве данных.
## @param array  $create_data  Массив данных из которых нужно созать CSV файл.
## @param string $file         Путь до файла 'path/to/test.csv'. Если не указать, то просто вернет результат.
## @return string/false        CSV строку или false, если не удалось создать файл.
## ver 2
function kama_create_csv_file( $create_data, $file = null, $col_delimiter = ';', $row_delimiter = "\r\n" ){

	if( ! is_array($create_data) )
		return false;

	if( $file && ! is_dir( dirname($file) ) )
		return false;

	// строка, которая будет записана в csv файл
	$collected_rows = array() ;

	// перебираем все данные
	foreach( $create_data as $row ){
		$cols = array();

		foreach( $row as $col_val ){
			// строки должны быть в кавычках ""
			// кавычки " внутри строк нужно предварить такой же кавычкой "
			if( $col_val && preg_match('/[",;\r\n]/', $col_val) ){
				// поправим перенос строки
				if( $row_delimiter === "\r\n" ){
					$col_val = str_replace( "\r\n", '\n', $col_val );
					$col_val = str_replace( "\r", '', $col_val );
				}
				elseif( $row_delimiter === "\n" ){
					$col_val = str_replace( "\n", '\r', $col_val );
					$col_val = str_replace( "\r\r", '\r', $col_val );
				}

				$col_val = str_replace( '"', '""', $col_val ); // предваряем "
				$col_val = '"'. $col_val .'"'; // обрамляем в "
			}

			$cols[] = $col_val; // добавляем колонку в данные
		}

		$collected_rows[] = implode( $col_delimiter, $cols ); // добавляем строку в данные
	}

	$CSV_str = implode( $row_delimiter, $collected_rows ); // объединяем строки

	// задаем кодировку windows-1251 для строки
	if( $file ){
		$CSV_str = iconv( "UTF-8", "cp1251",  $CSV_str );

		// создаем csv файл и записываем в него строку
		$done = file_put_contents( $file, $CSV_str );

		if( $done )
			return $CSV_str;
		return false;
	}

	return $CSV_str;

}
/*========================================================
		*	
		========================================================*/


## Читает CSV файл и возвращает данные в виде массива.
## @param string $file_path Путь до csv файла.
## string $col_delimiter Разделитель колонки (по умолчанию автоопределине)
## string $row_delimiter Разделитель строки (по умолчанию автоопределине)
## ver 6
function kama_parse_csv_file( $file_path, $file_encodings = ['cp1251','UTF-8'], $col_delimiter = '', $row_delimiter = "" ){

	if( ! file_exists($file_path) )
		return false;

	$cont = trim( file_get_contents( $file_path ) );

	$encoded_cont = mb_convert_encoding( $cont, 'UTF-8', mb_detect_encoding($cont, $file_encodings) );

	// определим разделитель
	if( ! $row_delimiter ){
		$row_delimiter = "\r\n";
		if( false === strpos($encoded_cont, "\r\n") )
			$row_delimiter = "\n";
	}

	$lines = explode( $row_delimiter, trim($encoded_cont) );
	$lines = array_filter( $lines );
	$lines = array_map( 'trim', $lines );

	// авто-определим разделитель из двух возможных: ';' или ','. 
	// для расчета берем не больше 30 строк
	if( ! $col_delimiter ){
		$lines10 = array_slice( $lines, 0, 30 );

		// если в строке нет одного из разделителей, то значит другой точно он...
		foreach( $lines10 as $line ){
			if( ! strpos( $line, ',') ) $col_delimiter = ';';
			if( ! strpos( $line, ';') ) $col_delimiter = ',';

			if( $col_delimiter ) break;
		}

		// если первый способ не дал результатов, то погружаемся в задачу и считаем кол разделителей в каждой строке.
		// где больше одинаковых количеств найденного разделителя, тот и разделитель...
		if( ! $col_delimiter ){
			$delim_counts = array( ';'=>array(), ','=>array() );
			foreach( $lines10 as $line ){
				$delim_counts[','][] = substr_count( $line, ',' );
				$delim_counts[';'][] = substr_count( $line, ';' );
			}

			$delim_counts = array_map( 'array_filter', $delim_counts ); // уберем нули

			// кол-во одинаковых значений массива - это потенциальный разделитель
			$delim_counts = array_map( 'array_count_values', $delim_counts );

			$delim_counts = array_map( 'max', $delim_counts ); // берем только макс. значения вхождений

			if( $delim_counts[';'] === $delim_counts[','] )
				return array('Не удалось определить разделитель колонок.');

			$col_delimiter = array_search( max($delim_counts), $delim_counts );
		}

	}

	$data = [];
	foreach( $lines as $line ){
		$data[] = str_getcsv( $line, $col_delimiter ); // linedata
	}

	return $data;
}
/*========================================================
		*		
		========================================================*/

$create_data = array(
	array(
		'Заголовок 1',
		'Заголовок 2',
		'Заголовок 3',
	),
	array(
		'строка 2 "столбец 1"',
		'4799,01',
		'строка 2 "столбец 3"',
	),
	array(
		'"Ёлочки"',
		4900.01,
		'красный, зелёный',
	)
);
 kama_create_csv_file( $create_data, get_template_directory(). '/' .'csv_file.csv' );

 $data = kama_parse_csv_file(get_template_directory(). '/' .'csv_file.csv' );
print_r( $data );