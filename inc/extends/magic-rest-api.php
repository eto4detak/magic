<?php 
/*========================================================
         ==4== 
        ========================================================*/
// add_action( 'rest_api_init', function () {
//  register_rest_route( 'myplugin/v1', '/author/(?P\d+)', array(
//      'methods' => 'GET',
//      'callback' => 'magic_get_data_site',
//      'args' => array(
//          'id' => array(
//              'validate_callback' => function($param, $request, $key) {
//                  return is_numeric( $param );
//              }
//          ),
//      ),
//      )
//   );
// } );

//для маршрутизации без имен ///  http://example.com/wp-json/xxxx
add_action( 'rest_api_init', function ( $server ) {
    $server->register_route( 'infosite', '/infosite', array(
        'methods'  => 'GET',
        'callback' => 'magic_get_data_site',
    ) );
}
 );
function magic_get_data_site( WP_REST_Request $request)
{
	if(0){
		// $param = $request['some_param'];
		// $param = $request->get_param( 'some_param' );
		// $parameters = $request->get_params();
		// $parameters = $request->get_url_params();
		// $parameters = $request->get_query_params();
		// $parameters = $request->get_body_params();
		$parameters = $request->get_json_params();
		// $parameters = $request->get_default_params();
		// $parameters = $request->get_file_params();
		// var_dump($request);
		var_dump($parameters);
		return 'site ' . get_bloginfo('name') ;
	}else{
		$data = array( 'some', 'response', 'data' );
		$response = new WP_REST_Response( $data );
		$response->set_status( 201 );
		$response->header( 'Location', 'http://example.com/' );
		return 'qqq';
	}

}

 ?>